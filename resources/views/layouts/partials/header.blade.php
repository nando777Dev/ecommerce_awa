<header>
    <nav class="navbar navbar-default navbar-sticky bootsnav">
        <div class="container">
            <div class="attr-nav">
                <ul>
                    <li class="cart-toggler">
                        <a href="#.">
                            <i class="fa fa-shopping-cart">
                            </i>
                            <span class="badge">{{ \Cart::getContent()->count() }}
                       </span>
                        </a>
                    </li>
                    <li class="search">
                        <a href="#.">
                            <i class="fa fa-search">
                            </i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars">
                    </i>
                </button>
                <a class="navbar-brand" href="index.html">
                    Awa Desginer
                </a>
            </div>
            <!-- End Header Navigation -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right" data-in="fadeIn" data-out="fadeOut">
                    <li class="dropdown active">
                    <li>
                        <a href="/">Home
                        </a>
                    </li><li>
                        <a href="/produtos">Produtos
                        </a>
                    </li>
                    <li>
                        <a href="#.">Coleção
                        </a>
                    </li>
                    <li>
                        <a href="#.">Sobre nós
                        </a>
                    </li>
                    <li>
                        <a href="contact.html">Contate-nos
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <div class=" search-toggle">
                <div class="top-search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-addon">
                  <i class="fa fa-search">
                  </i>
                </span>
                    </div>
                </div>
            </div>
            <ul class="cart-list">
                <li class="total clearfix">
                    <div class="pull-right">
                        <strong>Shipping
                        </strong>: $5.00
                    </div>
                    <div class="pull-left">
                        <strong>Total
                        </strong>: {{\Cart::getSubTotal()}}
                    </div>
                </li>
                <li class="cart-btn">
                    <a href="/cart" class="active">Ver carrinho
                    </a>
                    <a href="#.">CHECKOUT
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
