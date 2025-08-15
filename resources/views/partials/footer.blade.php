{{--
  Este es el pie de página personalizado para el panel de Filament.
  Usa clases de Tailwind CSS para el diseño y los iconos están integrados como SVG.
--}}
<footer class="bg-gray-800 text-gray-300 dark:bg-gray-900/50 filament-footer">
    <div class="mx-auto w-full max-w-screen-xl p-6 lg:py-8">
        {{-- Contenedor principal con Grid para las 3 columnas --}}
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

            {{-- Columna 1: Marca --}}
            <div class="mb-6 md:mb-0">
                <h2 class="mb-4 text-sm font-semibold uppercase text-white">Cyberpharma</h2>
                <p class="text-gray-400">
                    Tu aliado en la gestión de droguerías.
                </p>
            </div>

            {{-- Columna 2: Información --}}
            <div>
                <h2 class="mb-4 text-sm font-semibold uppercase text-white">Información</h2>
                <ul class="space-y-3 font-medium text-gray-400">
                    <li>
                        <a href="#" class="hover:underline">Política de Privacidad</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Términos y Condiciones</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Acerca de Nosotros</a>
                    </li>
                </ul>
            </div>

            {{-- Columna 3: Contacto --}}
            <div>
                <h2 class="mb-4 text-sm font-semibold uppercase text-white">Contacto</h2>
                <ul class="space-y-3 font-medium text-gray-400">
                    <li class="flex items-center gap-x-2">
                        @svg('heroicon-s-phone', 'h-5 w-5')
                        <span>+57 310 123 4567</span>
                    </li>
                    <li class="flex items-center gap-x-2">
                        @svg('heroicon-s-envelope', 'h-5 w-5')
                        <span>info@cyberpharma.com</span>
                    </li>
                </ul>

                {{-- Iconos de Redes Sociales --}}
                <div class="mt-4 flex space-x-5">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.345 2.525c.636-.247 1.363-.416 2.427-.465C9.808 2.013 10.162 2 12.315 2zm-1.163 1.943h-1.487c-1.226 0-1.616.59-1.616 1.585v1.928H7.394v2.32h.955v5.378h2.348v-5.378h1.964l.25-2.32h-2.214v-1.724c0-.671.186-1.14 1.154-1.14h1.229V3.943z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.206v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.337 7.433c-.945 0-1.71-.765-1.71-1.71s.765-1.71 1.71-1.71 1.71.765 1.71 1.71-.765 1.71-1.71 1.71zm1.336 8.905H4.002v-8.59h2.671v8.59zM17.668 2H6.332C4.1 2 2.332 3.844 2.332 6.098v11.804C2.332 20.156 4.1 22 6.332 22h11.336c2.234 0 4.002-1.844 4.002-4.098V6.098C21.67 3.844 19.902 2 17.668 2z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Línea divisoria y Copyright --}}
        <hr class="my-6 border-gray-700 sm:mx-auto lg:my-8" />
        <div class="text-center">
            <span class="text-sm text-gray-400">© {{ date('Y') }} CyberPharma. Todos los derechos reservados.</span>
        </div>
    </div>
</footer>