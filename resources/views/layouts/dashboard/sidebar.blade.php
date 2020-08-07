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
            <li class="nav-item {{ url()->current() == route('supports.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('supports.index') }}">
                    <p>Chamados</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('supports.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('supports.create') }}">
                    <p>Abrir Chamado</p>
                </a>
            </li>
            {{-- <li class="nav-item {{ url()->current() == route('supports.print.avulsa') ? 'active' : '' }}">
                <a class="nav-link" target="_blank" href="{{ route('supports.print.avulsa') }}">
                    <p>OS Avulsa</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('ajuda.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('ajuda.index') }}">
                    <p>Ajuda</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
