<div class="backtotop">
    <a class="btn-floating btn primary-bg">
        <i class="mdi mdi-chevron-up"></i>
    </a>
</div>

<form id="formLogout" method="POST" action="/logout">
    @csrf
</form>

<div class="footer-menu circular">
    <ul class="d-flex align-items-centerd-flex align-items-center justify-content-center">
        <li>
            <a href="/menu" class="{{ Request::is('menu*') ? 'active' : '' }}">
                <i class="mdi mdi-menu"></i>
                <span>
                    Menu
                </span>
            </a>
        </li>

        <li>
            <a href="/keranjang" class="{{ Request::is('keranjang*') ? 'active' : '' }}">
                <i class="mdi mdi-cart"></i>
                <span>
                    Keranjang
                </span>
            </a>
        </li>

        <li>
            <a href="/pesanan" class="{{ Request::is('pesanan*') ? 'active' : '' }}">
                <i class="mdi mdi-playlist-check"></i>
                <span>
                    Pesanan
                </span>
            </a>
        </li>

        <li>
            <a href="javascript:void(0)" onclick="confirmLogout()">
                <i class="mdi mdi-logout"></i>
                <span>
                    Logout
                </span>
            </a>
        </li>

    </ul>
</div>
