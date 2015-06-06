/**
 * Created by mac on 15/6/2.
 */


//$POST = function(url,data,token){
//
//    data["_token"] = '{{ csrf_token() }}';
//    $.post(url,data);
//}

$(function() {

    var data = JSON.parse($('#dish_data').val());

    var dishes = {

        total_amount:totalAmount,
        total_price:totalPrices,
        o_total_price:$(".shopping-cart .dish-price"),
        carts_data:{},


        init:function(){

            var self = this;

            // 点击菜单列表中的 ＋ 号按钮
            $(".dish-operation .add").click(function(){

                $this = $(this);
                var index = $this.data("index");
                var amount = +$this.siblings('.amount').html();
                if (amount == 0) {
                    $this.siblings('.minus').css({'display':'inline-block'});
                    $this.siblings('.amount').css({'display':'inline-block'});
                }
                $this.siblings('.amount').html(++amount);
                self.add_dishes(index);

            });

            // 点击菜单列表中的 - 号按钮
            $(".dish-operation .minus").click(function(){

                $this = $(this);
                var index = $this.data("index");
                var amount = +$this.siblings('.amount').html();
                if (amount == 1) {
                    $this.css({'display':'none'});
                    $this.siblings('.amount').css({'display':'none'});
                }

                $this.siblings('.amount').html(--amount);
                self.minus_dishes(index);

            });

            // 点击选好了按钮
            $('#payment_button').click(function(){
                self.confirm_order();
            });
            $('span.value').click(self.toggleCart);

        },
        // 加一份菜
        add_dishes:function(index){

            var dish_data = data[index];
            this.total_amount ++;
            if (this.total_amount == 1) {
                $(".dish-count .value .cart-icon").css({'display':'none'})
            }
            this.total_price += parseFloat(dish_data["price"]);

            $(".dish-count .value .total-amount").html(this.total_amount);
            this.o_total_price.html(this.total_price);


            var cart_dish = this.carts_data[index] || {id:dish_data["id"],name:dish_data["name"],amount:$(".dish-operation .amount").html()};
            cart_dish["amount"] ++;
            this.carts_data[index] = cart_dish;

            $.post('/cart/increase-dishes',{
                'dishes_id':cart_dish['id'],
                'open_id':1,
                '_token':$('#csrf_totken').val()
            });

        },
        // 减一份菜
        minus_dishes:function(index){

            var dish_data = data[index];
            this.total_amount --;

            if (this.total_amount == 0) {
                $(".dish-count .value .total-amount").html("");
                $(".dish-count .value .cart-icon").css({'display':'inline-block'})
            } else {
                $(".dish-count .value .total-amount").html(this.total_amount);
            }

            this.total_price -= parseFloat(dish_data["price"]);
            this.o_total_price.html(this.total_price);

            var cart_dish = this.carts_data[index] || {id:dish_data["id"],name:dish_data["name"],amount:$(".dish-operation .amount").html()};
            cart_dish["amount"] -- ;

            if (cart_dish['amount'] == 0) {
                delete this.carts_data[index];
            } else {
                this.carts_data[index] = cart_dish;
            }

            $.post('/cart/decrease-dishes',{
                'dishes_id':cart_dish['id'],
                'open_id':1,
                '_token':$('#csrf_totken').val()
            });

        },
        confirm_order:function() {

            $('#carts_data').val(JSON.stringify(this.carts_data));

            if (this.total_price > 0) {
                $('#confirm_order').submit();
            } else {
                $('#no-dishes-alert').modal();

            }

        },
        toggleCart:function(){

            if($('#cart-panel').hasClass('down'))
            {
                $('#cart-panel,#cart').addClass('up').removeClass('down');
            }

            else
            {
                $('#cart-panel,#cart').addClass('down').removeClass('up');
            }
        }

    };
    dishes.init();

})