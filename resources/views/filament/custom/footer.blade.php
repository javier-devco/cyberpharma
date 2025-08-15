{{-- Ruta: resources/views/filament/custom/footer.blade.php --}}
<footer class="px-8 py-12 text-white bg-gray-800 dark:bg-gray-900">
    <div class="container grid grid-cols-1 gap-8 mx-auto md:grid-cols-3">
        <div>
            <h4 class="text-lg font-bold">CYBERPHARMA</h4>
            <p class="mt-2 text-sm text-gray-400">Tu aliado en la gestión de droguerías.</p>
        </div>
        <div>
            <h4 class="text-lg font-bold">INFORMACIÓN</h4>
            <ul class="mt-2 space-y-2 text-sm">
                <li><a href="#" class="text-gray-400 hover:text-white">Política de Privacidad</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white">Términos y Condiciones</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white">Acerca de Nosotros</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-lg font-bold">CONTACTO</h4>
            <ul class="mt-2 space-y-2 text-sm">
                <li class="flex items-center gap-2">
                    <i class="fa-solid fa-phone"></i> {{-- Icono de Heroicons cambiado a FontAwesome --}}
                    <span class="text-gray-400">+57 310 123 4567</span>
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-solid fa-envelope"></i> {{-- Icono de Heroicons cambiado a FontAwesome --}}
                    <span class="text-gray-400">info@cyberpharma.com</span>
                </li>
            </ul>
            {{-- ¡SINTAXIS DE ICONOS CORREGIDA! --}}
            <div class="flex gap-4 mt-4">
                <a href="#" class="text-gray-400 hover:text-white"><i class="text-xl fa-brands fa-facebook-f"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="text-xl fa-brands fa-twitter"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="text-xl fa-brands fa-instagram"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="text-xl fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
    <div class="pt-8 mt-8 text-sm text-center text-gray-500 border-t border-gray-700">
        &copy; {{ date('Y') }} CyberPharma. Todos los derechos reservados.
    </div>
</footer>