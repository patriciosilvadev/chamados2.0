<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('/img/masp.jpg') }}">
    <div class="logo">
        <a href="{{ route('dashboard.index') }}" class="simple-text logo-normal">Chamados <span class="masp-logo">MASP</span></a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ url()->current() == route('dashboard.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <p>Chamados</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('chamado.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('chamado.create') }}">
                    <p>Abrir Chamado</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('chamado.print.avulsa') ? 'active' : '' }}">
                <a class="nav-link" target="_blank" href="{{ route('chamado.print.avulsa') }}">
                    <p>OS Avulsa</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('ajuda.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('ajuda.index') }}">
                    <p>Ajuda</p>
                </a>
            </li>
        </ul>
    </div>
</div>
