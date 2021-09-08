export { loadCart, sendEmail }

var cart = {};

function init() {
    //читаем c db
    $.post(
        "admin/core/core.php",
        {
            "action": "goodsOut"
        },
        goodsOut,
    ).done(function () {
        console.log('Данные получены');
    }
    ).fail(function () {
        console.log('что-то пошло не так');
    });
}

function goodsOut(data) {
    //вывод товара на главную страницу
    console.log('1: ' + data);
    data = JSON.parse(data);
    console.log('2: ' + data);

    let out = "";
    for (let key in data) {
        out += `<div class="cart">
                    <button class="add-to-whish-list" data-id="${key}"><i class="fa fa-heart" aria-hidden="true"></i></button>
                    <p class="name">${data[key].name}</p>
                    <img src="public/img/${data[key].img}" alt="good">
                    <div class="cost">${data[key].cost}</div>
                    <button class="add-to-cart" data-id="${key}">Купить</button>
                </div>
               `;

    }
    $('.goods-out').html(out);
    $('.add-to-cart').on('click', addToCart);
    $('.add-to-whish-list').on('click', addToWhishList);

}

function addToCart() {
    //добавляем товар в карзину
    let id = $(this).attr('data-id');
    if (cart[id] == undefined) {
        cart[id] = 1;
    } else {
        cart[id]++;
    }
    showMiniCart();
    safeCart();
}

function addToWhishList() {
    var wish = [];
    if (localStorage.getItem('wish')) {
        wish = JSON.parse(localStorage.getItem('wish'));
    }
    alert('добавлено в желаемое');
    let id = $(this).attr('data-id');
    wish[id] = 1;
    localStorage.setItem('wish', JSON.stringify(wish));
}

function safeCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function showMiniCart() {
    let sum = 0;
    $.getJSON("goods.json", goodsOut);
    for (let key in cart) {
        sum += cart[key];
    }
    sum = ":  " + sum + "  ";
    $('.mini-cart i').text(sum);
}



function loadCart() {
    if (localStorage.getItem('cart')) {
        cart = JSON.parse(localStorage.getItem('cart'));
        showMiniCart();
        if (!isEmpty(cart)) {
            $('.main-cart').html('Корзина пуста');
        } else {
            showCart();
        }
    } else {
        $('.main-cart').html('Корзина пуста');
    }
}

function showCart() {
    if (!isEmpty(cart)) {
        $('.main-cart').html('Корзина пуста');
    }
    else {
        $.getJSON('goods.json', function (data) {
            var goods = data;
            var out = '';
            var sum = 0;
            for (let id in cart) {
                out += `
                    <button data-id="${id}" class="del-good">X</button>
                    <img src="public/img/${goods[id].img}">
                    <span>${goods[id].name}</span>
                    <button data-id="${id}" class="minus-good">-</button>
                    <span>${cart[id]}</span>
                    <button data-id="${id}" class="plus-good">+</button>
                    <span>${cart[id]} шт. x ${goods[id].cost}р. = ${cart[id] * goods[id].cost}р.</span >

        <br>

            `;
                sum += cart[id] * goods[id].cost;
            }
            out += `<br>Стоимость всего:${sum}`;
            $('.main-cart').html(out);
            $('.del-good').on('click', delGood);
            $('.plus-good').on('click', plusGood);
            $('.minus-good').on('click', minusGood);
        });
    }
}

function delGood() {
    var id = $(this).attr('data-id');
    delete cart[id];
    safeCart();
    showCart();
}
function plusGood() {
    var id = $(this).attr('data-id');
    cart[id]++;
    safeCart();
    showCart();
}
function minusGood() {
    var id = $(this).attr('data-id');
    if (cart[id] == 1) {
        delete cart[id];
    } else {
        cart[id]--;
    }
    safeCart();
    showCart();
}


$(document).ready(function () {
    init();
    loadCart();
});

function isEmpty() {
    for (var key in cart) {
        if (cart.hasOwnProperty(key)) {
            return true;
        } else {
            return false;
        }
    }
}
function sendEmail() {
    var ename = $('#ename').val();
    var email = $('#email').val();
    var ephone = $('#ephone').val();
    if (ename != '' && email != '' && ephone != '') {
        if (isEmpty(cart)) {
            $.post(
                "engine/mail.php",
                {
                    "ename": ename,
                    "email": email,
                    "ephone": ephone,
                    "cart": cart
                }, function (data) {
                    if (data == 1) {
                        alert('Заказ отправлен');
                    } else {
                        alert('Повторите заказ');
                    }
                }
            );
        } else {
            alert("Корзина пуста");
        }
    } else {
        alert('заполните поля!');
    }
}