<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>U.P.R. Solar Green Energy™</title>
    <meta name="description" content="MNRE & ISO Certified Solar Company in Kanpur. Solar panels, rooftop systems, inverters, and batteries by U.P.R. Solar Green Energy™." />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            colors: {
              solarGreen: '#2ECC71',
              deepGreen: '#27AE60',
              solarOrange: '#F39C12',
              navyBlue: '#2C3E50',
              lightEco: '#E8F8F5',
              warmGlow: '#FDEBD0',
            },
            fontFamily: {
              sans: ['Inter', 'sans-serif'],
              heading: ['Poppins', 'sans-serif'],
            },
            animation: {
              'fade-in-up': 'fadeInUp 1s ease-out forwards',
              'float': 'float 3s ease-in-out infinite',
            },
            keyframes: {
              fadeInUp: {
                '0%': { opacity: '0', transform: 'translateY(20px)' },
                '100%': { opacity: '1', transform: 'translateY(0)' },
              },
              float: {
                '0%, 100%': { transform: 'translateY(0)' },
                '50%': { transform: 'translateY(-10px)' },
              }
            }
          }
        }
      }
    </script>
    <style>
      body { font-family: 'Inter', sans-serif; }
      h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
      
      /* Smooth scrolling */
      html { scroll-behavior: smooth; }

      /* Underline animation */
      .hover-underline-animation {
        display: inline-block;
        position: relative;
      }
      .hover-underline-animation::after {
        content: '';
        position: absolute;
        width: 100%;
        transform: scaleX(0);
        height: 2px;
        bottom: -4px;
        left: 0;
        background-color: #2ECC71;
        transform-origin: bottom right;
        transition: transform 0.25s ease-out;
      }
      .hover-underline-animation:hover::after {
        transform: scaleX(1);
        transform-origin: bottom left;
      }
    </style>
</head>
<body class="bg-white text-navyBlue transition-colors duration-300 min-h-screen flex flex-col pt-20">

    <!-- Sticky Header -->
    <nav class="bg-white shadow-sm fixed w-full top-0 z-50">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <svg class="h-8 w-8 text-solarGreen" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="font-heading font-bold text-xl md:text-2xl text-solarGreen tracking-tight">U.P.R. Solar Green Energy™</span>
                </a>

                <!-- Nav Links -->
                <div class="hidden lg:flex space-x-8 items-center text-sm font-medium text-navyBlue">
                    <a href="{{ route('home') }}" class="hover-underline-animation py-1 transition-colors">Home</a>
                    <a href="#" class="hover-underline-animation py-1 transition-colors">About</a>
                    <a href="{{ route('solar-products.index') }}" class="hover-underline-animation py-1 transition-colors">Products</a>
                    <a href="#" class="hover-underline-animation py-1 transition-colors">Services</a>
                    <a href="#" class="hover-underline-animation py-1 transition-colors">Gallery</a>
                    <a href="#" class="hover-underline-animation py-1 transition-colors">Projects</a>
                    <a href="#" class="hover-underline-animation py-1 transition-colors">Contact</a>
                </div>

                <!-- Right Actions -->
                <div class="hidden lg:flex items-center space-x-6 text-navyBlue">
                    <!-- Moon Icon -->
                    <button class="hover:text-solarGreen transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>
                    <!-- Cart Icon -->
                    <a href="#" class="hover:text-solarGreen transition-colors relative">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </a>
                    <!-- Portal Button -->
                    <a href="#" class="bg-solarGreen text-white px-5 py-2.5 rounded-lg font-medium flex items-center gap-2 hover:bg-deepGreen transition-all transform hover:-translate-y-0.5 shadow-sm">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Portal
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow w-full">
        @yield('content')
    </main>

    <!-- Footer Banner -->
    <div class="bg-solarGreen text-white text-center py-10 px-4">
        <p class="text-lg md:text-xl font-medium mb-6">Use our advanced quotation generator to get a precise estimate for your project size.</p>
        <a href="#" class="inline-block bg-white text-solarGreen px-8 py-3 rounded-lg font-bold hover:bg-lightEco transition-all shadow-md transform hover:-translate-y-1">Get Custom Quote</a>
    </div>

    <!-- Main Footer -->
    <footer class="bg-[#2A3B4C] text-gray-300 border-t-[6px] border-solarGreen">
        <div class="max-w-[1400px] mx-auto px-4 lg:px-8 py-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Brand -->
            <div>
                <a href="{{ route('home') }}" class="font-heading font-bold text-2xl text-solarGreen mb-4 block">U.P.R. Solar Green Energy™</a>
                <p class="text-sm text-gray-400 mb-6 leading-relaxed">MNRE & ISO Certified Solar Company. Powering India with clean, renewable energy solutions since 2013.</p>
                <!-- Socials -->
                <div class="flex items-center gap-4">
                    <a href="#" class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center hover:bg-solarGreen hover:border-solarGreen hover:text-white transition-all transform hover:scale-110">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.07C24 5.41 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.5c-1.5 0-1.96.93-1.96 1.89v2.26h3.32l-.53 3.5h-2.8V24C19.62 23.1 24 18.1 24 12.07"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center hover:bg-solarGreen hover:border-solarGreen hover:text-white transition-all transform hover:scale-110">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.95 4.57a10 10 0 01-2.82.77 4.96 4.96 0 002.16-2.72c-.95.55-2 .95-3.12 1.17a4.92 4.92 0 00-8.39 4.48A14 14 0 011.67 3.15 4.92 4.92 0 003.2 9.72a4.9 4.9 0 01-2.23-.62v.06a4.92 4.92 0 003.95 4.83 4.86 4.86 0 01-2.22.08 4.93 4.93 0 004.6 3.42A9.87 9.87 0 010 19.54a13.94 13.94 0 007.55 2.21c9.06 0 14-7.5 14-14v-.64c.96-.7 1.8-1.56 2.4-2.54z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center hover:bg-solarGreen hover:border-solarGreen hover:text-white transition-all transform hover:scale-110">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="flex flex-col gap-3">
                <h3 class="text-white font-heading font-bold text-lg mb-2">Quick Links</h3>
                <a href="{{ route('home') }}" class="hover:text-solarGreen transition-colors text-sm">Home</a>
                <a href="#" class="hover:text-solarGreen transition-colors text-sm">About Us</a>
                <a href="#" class="hover:text-solarGreen transition-colors text-sm">Gallery</a>
                <a href="{{ route('solar-products.index') }}" class="hover:text-solarGreen transition-colors text-sm">Shop Products</a>
                <a href="#" class="hover:text-solarGreen transition-colors text-sm">Projects</a>
                <a href="#" class="hover:text-solarGreen transition-colors text-sm">Certifications</a>
                <a href="#" class="hover:text-solarGreen transition-colors text-sm">Partner Portal</a>
            </div>

            <!-- Our Services -->
            <div class="flex flex-col gap-3">
                <h3 class="text-white font-heading font-bold text-lg mb-2">Our Services</h3>
                <a href="#" class="hover:text-solarGreen transition-colors text-sm">Rooftop Solar</a>
                <a href="#" class="hover:text-solarGreen transition-colors text-sm">Commercial Plants</a>
                <a href="#" class="hover:text-solarGreen transition-colors text-sm">Solar Water Heaters</a>
                <a href="#" class="hover:text-solarGreen transition-colors text-sm">AMC & Maintenance</a>
            </div>

            <!-- Contact -->
            <div class="flex flex-col gap-4">
                <h3 class="text-white font-heading font-bold text-lg mb-2">Contact Us</h3>
                <div class="flex gap-3 items-start text-sm">
                    <svg class="h-5 w-5 text-solarGreen shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <p>Near IIT Metro Station, Kanpur, Uttar Pradesh, India</p>
                </div>
                <div class="flex gap-3 text-sm">
                    <svg class="h-5 w-5 text-solarGreen" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <p>+91-9412452844</p>
                </div>
                <div class="flex gap-3 text-sm">
                    <svg class="h-5 w-5 text-solarGreen" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <p>info@uprsolargreenenergy.com</p>
                </div>
            </div>
        </div>

        <!-- Copyright & Scroll to Top Bottom -->
        <div class="border-t border-gray-700">
            <div class="max-w-[1400px] mx-auto px-4 lg:px-8 py-6 relative flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <p>&copy; 2026 U.P.R. Solar Green Energy™ (U.P. Refrigeration & Sales Co.). All Rights Reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-white transition-colors">Help Center</a>
                </div>
                <!-- Float right button -->
                <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="absolute -top-6 right-8 bg-solarGreen hover:bg-deepGreen text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg transform hover:-translate-y-1 transition-all z-10">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                </button>
            </div>
        </div>
    </footer>

</body>
</html>
