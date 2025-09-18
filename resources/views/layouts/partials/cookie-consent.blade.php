/<div id="cookie-consent-banner" class="fixed bottom-0 left-0 w-full bg-white dark:bg-[#161615] border-t border-[#e3e3e0] dark:border-[#3E3E3A] shadow-lg transform transition-all duration-300 translate-y-0 z-50 hidden">
    <div class="container mx-auto px-4 py-4 md:flex md:items-center md:justify-between">
        <div class="flex-1 mb-4 md:mb-0 pr-4">
            <h3 class="text-base font-medium mb-1">This website uses cookies</h3>
            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                We use cookies to enhance your browsing experience, serve personalized ads or content, and analyze our traffic. By clicking "Accept All", you consent to our use of cookies.
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <button id="cookie-customize" class="inline-block px-5 py-1.5 border border-[#19140035] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm">
                Customize
            </button>
            <button id="cookie-accept-all" class="inline-block px-5 py-1.5 bg-[#1b1b18] hover:bg-black dark:bg-[#eeeeec] dark:hover:bg-white text-white dark:text-[#1C1C1A] border border-black dark:border-[#eeeeec] dark:hover:border-white rounded-sm text-sm">
                Accept All
            </button>
        </div>
    </div>
</div>

<div id="cookie-settings-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white dark:bg-[#161615] rounded-lg shadow-xl max-w-lg w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-4 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium">Cookie Settings</h3>
                <button id="close-settings" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-4">
            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4">
                We use cookies to enhance your browsing experience, personalize content and ads, analyze our traffic, and for security purposes. You can choose which categories of cookies you allow.
            </p>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-medium">Necessary Cookies</h4>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">These cookies are essential for the website to function properly.</p>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="necessary-cookies" class="h-4 w-4 text-[#f53003] dark:text-[#FF4433]" checked disabled>
                        <label for="necessary-cookies" class="ml-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">Always active</label>
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-medium">Analytics Cookies</h4>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">These cookies help us understand how visitors interact with our website.</p>
                    </div>
                    <div class="relative inline-block w-10 mr-2 align-middle">
                        <input type="checkbox" id="analytics-cookies" class="cookie-toggle sr-only">
                        <label for="analytics-cookies" class="toggle-bg bg-gray-200 border-2 border-gray-200 rounded-full cursor-pointer w-10 h-5 flex items-center after:absolute after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:bg-gray-700 dark:border-gray-600 dark:after:bg-gray-400"></label>
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-medium">Marketing Cookies</h4>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">These cookies are used to deliver relevant ads and marketing campaigns.</p>
                    </div>
                    <div class="relative inline-block w-10 mr-2 align-middle">
                        <input type="checkbox" id="marketing-cookies" class="cookie-toggle sr-only">
                        <label for="marketing-cookies" class="toggle-bg bg-gray-200 border-2 border-gray-200 rounded-full cursor-pointer w-10 h-5 flex items-center after:absolute after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:bg-gray-700 dark:border-gray-600 dark:after:bg-gray-400"></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A] flex justify-end space-x-3">
            <button id="save-preferences" class="px-4 py-2 bg-[#1b1b18] hover:bg-black dark:bg-[#eeeeec] dark:hover:bg-white text-white dark:text-[#1C1C1A] border border-black dark:border-[#eeeeec] dark:hover:border-white rounded-sm text-sm">
                Save Preferences
            </button>
        </div>
    </div>
</div>

<style>
    .cookie-toggle:checked + .toggle-bg {
        @apply bg-[#f53003] border-[#f53003] dark:bg-[#FF4433] dark:border-[#FF4433];
    }
    .cookie-toggle:checked + .toggle-bg:after {
        @apply translate-x-5 bg-white dark:bg-white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const consentBanner = document.getElementById('cookie-consent-banner');
        const settingsModal = document.getElementById('cookie-settings-modal');
        const customizeBtn = document.getElementById('cookie-customize');
        const acceptAllBtn = document.getElementById('cookie-accept-all');
        const closeSettingsBtn = document.getElementById('close-settings');
        const savePreferencesBtn = document.getElementById('save-preferences');
        const analyticsCookies = document.getElementById('analytics-cookies');
        const marketingCookies = document.getElementById('marketing-cookies');
        
        // Check if consent has already been given
        const consentGiven = localStorage.getItem('cookie-consent');
        
        if (!consentGiven) {
            // Show the banner if no consent has been given
            setTimeout(() => {
                consentBanner.classList.remove('hidden');
                consentBanner.classList.remove('translate-y-full');
            }, 1000);
        } else {
            // If consent was previously given, apply those settings
            const consentSettings = JSON.parse(consentGiven);
            applyConsentSettings(consentSettings);
        }
        
        // Open settings modal
        customizeBtn.addEventListener('click', function() {
            consentBanner.classList.add('hidden');
            settingsModal.classList.remove('hidden');
            
            // If consent was previously given, check the appropriate toggles
            if (consentGiven) {
                const consentSettings = JSON.parse(consentGiven);
                analyticsCookies.checked = consentSettings.analytics || false;
                marketingCookies.checked = consentSettings.marketing || false;
            }
        });
        
        // Close settings modal
        closeSettingsBtn.addEventListener('click', function() {
            settingsModal.classList.add('hidden');
            if (!consentGiven) {
                consentBanner.classList.remove('hidden');
            }
        });
        
        // Accept all cookies
        acceptAllBtn.addEventListener('click', function() {
            const consentSettings = {
                necessary: true,
                analytics: true,
                marketing: true
            };
            
            saveConsent(consentSettings);
            consentBanner.classList.add('hidden');
        });
        
        // Save preferences
        savePreferencesBtn.addEventListener('click', function() {
            const consentSettings = {
                necessary: true, // Always required
                analytics: analyticsCookies.checked,
                marketing: marketingCookies.checked
            };
            
            saveConsent(consentSettings);
            settingsModal.classList.add('hidden');
        });
        
        // Function to save consent to localStorage
        function saveConsent(settings) {
            localStorage.setItem('cookie-consent', JSON.stringify(settings));
            applyConsentSettings(settings);
            
            // You can also send the consent to your server here
            // Example: sendConsentToServer(settings);
        }
        
        // Function to apply consent settings
        function applyConsentSettings(settings) {
            // Apply necessary cookies - always enabled
            
            // Apply analytics cookies if enabled
            if (settings.analytics) {
                enableAnalyticsCookies();
            } else {
                disableAnalyticsCookies();
            }
            
            // Apply marketing cookies if enabled
            if (settings.marketing) {
                enableMarketingCookies();
            } else {
                disableMarketingCookies();
            }
        }
        
        // Functions to enable/disable different types of cookies
        function enableAnalyticsCookies() {
            // Enable analytics cookies (Google Analytics, etc.)
            // Example: initializeGoogleAnalytics();
            console.log('Analytics cookies enabled');
        }
        
        function disableAnalyticsCookies() {
            // Disable analytics cookies
            // Example: disableGoogleAnalytics();
            console.log('Analytics cookies disabled');
        }
        
        function enableMarketingCookies() {
            // Enable marketing cookies (Facebook Pixel, etc.)
            // Example: initializeFacebookPixel();
            console.log('Marketing cookies enabled');
        }
        
        function disableMarketingCookies() {
            // Disable marketing cookies
            // Example: disableFacebookPixel();
            console.log('Marketing cookies disabled');
        }
        
        // Function to send consent to server (implementation depends on your backend)
        function sendConsentToServer(settings) {
            fetch('/api/cookie-consent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(settings)
            });
        }
    });
</script>