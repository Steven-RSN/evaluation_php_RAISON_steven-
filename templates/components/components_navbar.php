<nav style="border-bottom: 3px solid black; background-color:rgba(0, 0, 0, 0.3); padding:5px;">
    <ul>
        <li><strong>MyBook</strong></li>
    </ul>
    <ul style="margin: 5px;" >
        <!-- Menu Commun -->
        <li><a href="/">Home</a></li>
        <li><a href="/cgu">CGU</a></li>
        <!-- Menu déconnecté -->
        <?php if (!isset($_SESSION["email"])) : ?>
            <li><a href="/register">Register</a></li>
            <li><a href="/login">Login</a></li>
            <li><a href="/book">Ajouter un livre</a></li>

        <?php else : ?>
            <!-- Menu connecté -->
            <li><a href="/logout">Logout</a></li>
            <li><a href="/book">Ajouter un livre</a></li>
        <?php endif ?>
    </ul>
</nav>