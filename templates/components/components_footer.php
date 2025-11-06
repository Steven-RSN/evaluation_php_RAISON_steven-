<body style="display: flex; flex-direction: column; min-height: 80vh;">
    <div style="flex: 1;">
        <!-- Ton contenu ici -->
    </div>

    <footer class="container-fluid" style="margin-top: auto; padding: 1.5rem 0; border-top: 1px solid var(--muted-border-color); background-color:rgba(0, 0, 0, 0.3);">
        <div class="container">
            <nav style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <!-- Logo / Nom du site -->
                <ul style="list-style: none; margin: 0; padding: 0;">
                    <li><strong>MyBook</strong></li>
                    <li><small>&copy; <?= date('Y') ?> Tous droits réservés</small></li>
                </ul>

                <!-- Liens -->
                <ul style="list-style: none; display: flex; gap: 1rem; margin: 0; padding: 0;">
                    <li><a href="/cgu" class="contrast">CGU</a></li>
                    <li><a href="/contact" class="contrast">Contact</a></li>
                    <li><a href="https://github.com/" target="_blank" class="contrast">GitHub</a></li>
                </ul>
            </nav>
        </div>
    </footer>
</body>
