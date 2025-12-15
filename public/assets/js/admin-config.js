// Admin Portal Configuration
// This file contains all editable content for the website
// Update values here to change content across all pages

const AdminConfig = {
    // Site-wide settings
    siteName: "AlgoOne",
    siteTagline: "Professional Prop Firm Trading Management",
    
    // Header/Navigation
    header: {
        logo: "./assets/logo.png",
        brandName: "AlgoOne",
        navItems: [
            { text: "Past Performance", href: "past-performance.html" },
            { text: "Live Results", href: "live-results.html" },
            { text: "Signals", href: "#signals" }
        ],
        ctaButton: "Get Started",
        signInButton: "Sign In"
    },
    
    // Top Banner
    banner: {
        enabled: true,
        message: "LIMITED TIME: We're covering 30% of fees",
        extendedMessage: "+ Most prop firms have BOGO offers!"
    },
    
    // Hero Section
    hero: {
        badge: "WE ONLY MAKE MONEY WHEN YOU MAKE MONEY",
        badgeMobile: "PAY ONLY WHEN YOU PROFIT",
        title: "Professional Prop Firm",
        titleHighlight: "Trading Management",
        description: "We pass your prop firm challenges with precision and get you funded. Zero risk - if we fail, we refund you + $500.",
        rating: "5.0 Rating",
        tradersCount: "500+ traders",
        primaryButton: "Start Trading Now",
        secondaryButton: "Sign In"
    },
    
    // Signals Section
    signals: {
        badge: "FREE SIGNALS CHANNEL",
        title: "Elite Trading Signals -",
        titleHighlight: "Completely Free",
        description: "Join our exclusive signals channel where we share professional GBPJPY trades with an exceptional track record.",
        winRate: "80%",
        riskReward: "1:3",
        primaryMarket: "GBPJPY",
        whyDifferent: "Why We're Different",
        whyDifferentText: "While others charge hundreds or thousands for signal services, we believe everyone deserves a fair opportunity to start somewhere with trading. Our consistently profitable signals are shared completely free because we know that success in trading shouldn't be locked behind paywalls. Join thousands of traders who trust our analysis and execution on GBPJPY – one of the most reliable currency pairs with excellent volatility and liquidity.",
        ctaButton: "Join Free Signals Now"
    },
    
    // Footer
    footer: {
        copyright: "© 2025 AlgoOne. All rights reserved.",
        links: [
            { text: "Privacy Policy", href: "privacy.html" },
            { text: "Terms & Conditions", href: "terms-conditions.html" }
        ],
        disclaimer: "LEGAL DISCLAIMER — Notwithstanding any representations, warranties, or statements to the contrary contained herein or elsewhere, all quantitative performance indicators, statistical analyses, trading results, and any associated data visualizations or informational content displayed are NON-FACTUAL and constitute hypothetical simulations exclusively for demonstrative purposes. No actual transactions occur on this platform, and past performance is not indicative of future results."
    }
};

// Function to apply config to page elements
function applyAdminConfig() {
    // Apply header config
    const brandElements = document.querySelectorAll('[data-admin="brandName"]');
    brandElements.forEach(el => el.textContent = AdminConfig.header.brandName);
    
    // Apply banner config
    if (AdminConfig.banner.enabled) {
        const bannerElements = document.querySelectorAll('[data-admin="bannerMessage"]');
        bannerElements.forEach(el => el.textContent = AdminConfig.banner.message);
    }
    
    // Apply hero config
    const heroTitleElements = document.querySelectorAll('[data-admin="heroTitle"]');
    heroTitleElements.forEach(el => el.textContent = AdminConfig.hero.title);
    
    // Apply footer config
    const copyrightElements = document.querySelectorAll('[data-admin="copyright"]');
    copyrightElements.forEach(el => el.textContent = AdminConfig.footer.copyright);
}

// Auto-apply on page load
if (typeof window !== 'undefined') {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', applyAdminConfig);
    } else {
        applyAdminConfig();
    }
}

