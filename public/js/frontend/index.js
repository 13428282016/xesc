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

        total_amount:0,
        total_price:0.00,
        o_total_amount:$(".shopping-cart .amount"),
        o_total_price:$(".shopping-cart .price"),
        carts_data:{},

        init:function(){

            var self = this;
            $(".add").click(function(){
                var id = $(this).data("id");
                self.add_dishes(id);
            });

            $('#payment_button').click(function(){
                self.confirm_order();
            });

        },
        add_dishes:function(id){

            var dish_data = data[id];
            this.total_amount ++;
            this.total_price += parseFloat(dish_data["price"]);

            this.o_total_price.html(this.total_price);
            this.o_total_amount.html(this.total_amount);

            var cart_dish = this.carts_data[id] || {id:id,name:dish_data["name"],price:0.00,amount:0};
            cart_dish["price"] += parseFloat(dish_data["price"]);
            cart_dish["amount"] ++;
            this.carts_data[id] = cart_dish;

        },
        minus_dishes:function(id){

            var dish_data = data[id];
            this.total_amount --;
            this.total_price -= parseFloat(dish_data["price"]);

            this.o_total_price.html(this.total_price);
            this.o_total_amount.html(this.total_amount);

        },
        confirm_order:function() {

            $('#carts_data').val(JSON.stringify(this.carts_data));
            $('#confirm_order').submit();

        }

    };
    dishes.init();

})