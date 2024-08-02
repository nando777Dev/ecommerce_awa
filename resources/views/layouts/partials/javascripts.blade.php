
<!-- Inclua jQuery primeiro -->
<script src="{{ asset('js/jquery-2.2.3.js?v=' . $asset_v) }}"></script>


<!-- Inclua Bootstrap JS após jQuery -->
<script src="{{ asset('js/bootstrap.min.js?v=' . $asset_v) }}"></script>

<!-- Inclua DataTables após jQuery e Bootstrap -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Seus scripts personalizados -->



<script src="{{ asset('js/jquery.parallax-1.1.3.js?v=' . $asset_v) }}"></script>

<script src="{{ asset('js/jquery.appear.js?v=' . $asset_v) }}"></script>

<script src="{{ asset('js/owl.carousel.min.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/jquery.cubeportfolio.min.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/jquery.fancybox.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/jquery.themepunch.tools.min.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/jquery.themepunch.revolution.min.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/revolution.extension.layeranimation.min.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/revolution.extension.navigation.min.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/revolution.extension.parallax.min.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/revolution.extension.slideanims.min.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/revolution.extension.video.min.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/kinetic.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/jquery.final-countdown.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/bootsnav.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/produtos.js') }}"></script>
<script src="{{ asset('js/cart.js') }}"></script>




<!-- Scripts adicionais -->

@yield('javascript')

<script src="{{ asset('js/functions.js?v=' . $asset_v) }}"></script>


<!-- Scripts específicos para esta página -->
