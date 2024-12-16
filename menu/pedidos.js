function actSubtotales() {
                    var total = 0;
                    var subtotal = 0;
                    var row = {};
                    $(".item-table tbody tr:not(.hidden-row)").each(function(idx, el) {
                        row = {
                            'precio'     : parseInt($(el).find("[name='precio[]']").val()),
                            'cantidad'   : parseInt($(el).find("[name='cantidad[]']").val()),
                        };

                        subtotal = row.cantidad * row.precio;
                        total += subtotal;
                    }); 
                    
                    if(total>0){
                       $("#grabar").removeAttr("disabled");
                    }else{
                       $("#grabar").attr("disabled", "disabled"); 
                    }
                    $("#ven_total").val(formatNumber.new(total));
                }
                
                function actTotal(t) {
                    var vcant = $(t).parents("tr").find("[name='cantidad[]']").val(),
                        vprecio = $(t).parents("tr").find("[name='precio[]']").val(),
                        cantStock = $(t).parents('tr').find("[name='cantStock[]']").val();

                    $(t).next().val(vcant);
                    $(t).parents("tr").find(".row-subtotal").html(formatNumber.new(vprecio * vcant));
                    //pregunto si la cantidad ingresa supera a la cantidad del stock
                    if(parseInt(vcant) > parseInt(cantStock)){
                        mensajes("info","La cantidad solicitada supera a su stock..!"); 
                        $(t).parents("tr").find("[name='cantidad[]']").val(cantStock);
                        $(t).parents("tr").find(".row-subtotal").html(formatNumber.new(vprecio * cantStock));
                    }
                    
                    actSubtotales();
                }