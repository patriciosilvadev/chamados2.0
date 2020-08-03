<footer class="footer">
    <div class="container-fluid">
        <nav class="float-left">
            <ul>
                <li>
                    <a href="https://masp.org.br">
                        &copy;MASP&nbsp;{{ date('Y') }}
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright float-right">Ambiente: {{ strtoupper(config('app.env')) }}</div>
    </div>
</footer>
