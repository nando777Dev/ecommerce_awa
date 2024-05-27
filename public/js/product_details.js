$(document).ready(function() {
alert('script externo')

    $.ajax({
        url: 'http://127.0.0.1:8000/api/ecommerce/produtos',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Limpe o conteúdo existente antes de adicionar os novos elementos
            // $('#fourCol-slider').empty();

            // Itere sobre o array de objetos retornado
            response.forEach(function(produto) {
                // Crie a estrutura HTML para cada produto
                var produtoHTML = '<div class="item">' +
                    '<div class="product_wrap">' +
                    '<div class="image">' +
                    '<div class=""'
                '<div class="social">' +
                '<ul>' +
                '<li>' +
                '<a href="#.">' +
                '<i class="fa fa-expand"></i>' +
                '</a>' +
                '</li>' +
                '<li>' +
                '<a href="#.">' +
                '<i class="fa fa-exchange"></i>' +
                '</a>' +
                '</li>' +
                '<li>' +
                '<a href="#.">' +
                '<i class="fa fa-heart-o"></i>' +
                '</a>' +
                '</li>' +
                '</ul>' +
                '</div>' +
                '<a class="fancybox" href="' + produto.image_url + '">' +
                '<img src="' + produto.image_url + '" alt="Product" class="img-responsive custom-image">' + // Adicione a classe custom-image
                '</a>' +
                '</div>' +
                '<div class="product_desc">' +
                '<p>' + produto.name + '</p>' +
                '<span class="price">' +
                '<i class="fa fa-gbp"></i>' + produto.default_sell_price +
                '</span>' +
                '<a class="fancybox" href="' + produto.image_url + '" data-fancybox-group="gallery">' +
                '<i class="fa fa-shopping-bag open"></i>' +
                '</a>' +
                '</div>' +
                '</div>' +
                '</div>';

                // Adicione o HTML do produto ao elemento #fourCol-slider na página
                $('#fourCol-slider').append(produtoHTML);
            });

            $('.custom-image').css({
                'width': '270px', // Defina a largura desejada
                'height': '344px' // Defina a altura desejada
            });

            // Inicialize o plugin Owl Carousel após adicionar os produtos
            $('#fourCol-slider').owlCarousel({
                items: 4,
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    992: {
                        items: 4
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            // Manipule os erros de requisição aqui
            console.error(error);
        }

    });


});
