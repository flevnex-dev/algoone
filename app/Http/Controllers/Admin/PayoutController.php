<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use App\Models\User;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index()
    {
        $traders = User::where('role', 'trader')->orderBy('name')->get();
        
        return view('admin.pages.payouts.index', compact('traders'));
    }

    public function datatable(Request $request)
    {
        $query = Payout::with(['user', 'admin']);

        // Search functionality
        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('amount', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Get total count before pagination
        $totalRecords = Payout::count();
        $filteredRecords = $query->count();

        // Ordering
        if ($request->has('order') && count($request->order) > 0) {
            $orderColumn = $request->order[0]['column'] ?? 0;
            $orderDir = $request->order[0]['dir'] ?? 'desc';
            
            $columns = ['id', 'user_id', 'name', 'amount', 'payout_date', 'country', 'status', 'is_public', 'created_at'];
            $orderBy = $columns[$orderColumn] ?? 'id';
            
            if ($orderBy === 'user_id') {
                $query->join('users', 'payouts.user_id', '=', 'users.id')
                      ->orderBy('users.name', $orderDir)
                      ->select('payouts.*');
            } else {
                $query->orderBy('payouts.' . $orderBy, $orderDir);
            }
        } else {
            $query->orderBy('payouts.id', 'desc');
        }

        // Pagination
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $payouts = $query->skip($start)->take($length)->get();

        $data = [];
        foreach ($payouts as $payout) {
            $data[] = [
                'id' => $payout->id,
                'trader' => $payout->user->name ?? 'N/A',
                'trader_email' => $payout->user->email ?? '',
                'display_name' => $payout->name ?? 'N/A',
                'amount' => number_format($payout->amount, 2),
                'amount_raw' => $payout->amount,
                'date' => $payout->payout_date->format('M d, Y'),
                'date_raw' => $payout->payout_date->format('Y-m-d'),
                'country' => $payout->country ?? 'N/A',
                'status' => $payout->status,
                'is_public' => $payout->is_public,
                'notes' => $payout->notes ?? '',
                'user_id' => $payout->user_id,
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'name' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'payout_date' => 'required|date',
            'status' => 'required|in:pending,completed,cancelled',
            'is_public' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $validated['admin_id'] = auth()->id();
        $validated['is_public'] = $request->has('is_public');

        // If name is not provided, use partial name from user
        if (empty($validated['name']) && $validated['user_id']) {
            $user = User::find($validated['user_id']);
            if ($user) {
                $nameParts = explode(' ', $user->name);
                $validated['name'] = count($nameParts) > 1 
                    ? $nameParts[0] . ' ' . substr($nameParts[count($nameParts) - 1], 0, 1) . '.'
                    : $nameParts[0];
            }
        }

        // If country is not provided, use from user
        if (empty($validated['country']) && $validated['user_id']) {
            $user = User::find($validated['user_id']);
            if ($user && $user->country) {
                $validated['country'] = $user->country;
            }
        }

        Payout::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Payout created successfully'
            ]);
        }

        return redirect()->route('admin.payouts.index')
            ->with('success', 'Payout created successfully');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6', // Defaults to 123456
            'country' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
            'country' => $validated['country'],
            'role' => 'trader',
            'status' => 'active', // Default status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Trader user created successfully!',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'country' => $user->country
            ]
        ]);
    }

    public function update(Request $request, Payout $payout)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'name' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'payout_date' => 'required|date',
            'status' => 'required|in:pending,completed,cancelled',
            'is_public' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $validated['is_public'] = $request->has('is_public');

        $payout->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Payout updated successfully'
            ]);
        }

        return redirect()->route('admin.payouts.index')
            ->with('success', 'Payout updated successfully');
    }

    public function destroy(Request $request, Payout $payout)
    {
        try {
            $payoutId = $payout->id;
            $payout->delete();

            if ($request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') == 'XMLHttpRequest') {
                return response()->json([
                    'success' => true,
                    'message' => 'Payout deleted successfully'
                ]);
            }

            return redirect()->route('admin.payouts.index')
                ->with('success', 'Payout deleted successfully');
        } catch (\Exception $e) {
            \Log::error('Error deleting payout ID ' . ($payout->id ?? 'unknown') . ': ' . $e->getMessage());
            
            if ($request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') == 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => 'Error deleting payout: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.payouts.index')
                ->with('error', 'Error deleting payout: ' . $e->getMessage());
        }
    }

    public function show(Payout $payout)
    {
        $payout->load('user');
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $payout->id,
                'user_id' => $payout->user_id,
                'trader_name' => $payout->user->name ?? '',
                'trader_email' => $payout->user->email ?? '',
                'amount' => $payout->amount,
                'name' => $payout->name ?? '',
                'country' => $payout->country ?? '',
                'payout_date' => $payout->payout_date->format('Y-m-d'),
                'status' => $payout->status,
                'is_public' => $payout->is_public,
                'notes' => $payout->notes ?? '',
            ]
        ]);
    }
}
