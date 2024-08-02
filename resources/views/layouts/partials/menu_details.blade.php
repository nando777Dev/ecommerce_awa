
<style>
    .account-section {
        display: flex;
        height: calc(100vh - 100px); /* Ajuste a altura conforme necessário */
    }
    .account-menu {
        width: 200px;
        background-color: #ffffff;
        color: rgba(187, 6, 6, 0.29);
        padding-top: 20px;
        border-right: 1px solid #4444441a;
        overflow-y: auto;
    }
    .account-menu ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    .account-menu ul li {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #ffffff;
    }
    .account-menu ul li a {
        color: rgba(0, 0, 0, 0.29);
        text-decoration: none;
        display: block;
        padding: 10px;
        background-color: rgba(231, 231, 231, 0);
        transition-duration: 0.7s;
        text-align: center;
        width: 150px;
        margin: auto;
    }
    .account-menu ul li a:hover {
        background-color: rgb(191, 192, 193);
        color: rgb(255, 255, 255);
        cursor: pointer;
        transform: translateX(28px);
    }
    .account-content {
        flex-grow: 1;
        padding: 20px;
        overflow-y: auto;
    }
    .content {
        display: none;
    }
    .content.active {
        display: block;
    }
</style>

<section class="account-section">
    <nav class="account-menu">
        <ul>
            <li><a href="/minha-conta/details" class="navelement">Perfil</a></li>
            <li><a href="/minhas-compras" class="navelement">Minhas Compras</a></li>
            <li><a href="#" class="navelement" data-target="change-password">Menu</a></li>
        </ul>
    </nav>

</section>



