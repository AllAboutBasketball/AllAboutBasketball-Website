$(document).ready(function () {

    $(document).on('click','.delete_prod_btn', function (e) { 

        e.preventDefault();

        var id = $(this).val();

        //alert(id);

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                    $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'product_id':id,
                        'delete_prod_btn': true

                    },
                    success: function (response) {
                        if(response == 200)
                        {
                            
                            swal("Success", "Product Deleted Successfully", "success");
                            $("#product_table").load(location.href + " #product_table");
                        }
                        else if(response == 500)
                        {
                            swal("Error", "Something Went Wrong", "error");
                        }
                    }
                });
              
            }
          });
   });

   $(document).on('click','.delete_cate_btn', function (e) {
      
        e.preventDefault();

        var id = $(this).val();

        //alert(id);

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                    $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'category_id':id,
                        'delete_cate_btn': true

                    },
                    success: function (response) {
                        if(response == 200)
                        {
                            
                            swal("Success", "Category Deleted Successfully", "success");
                            $("#category_table").load(location.href + " #category_table");
                        }
                        else if(response == 500)
                        {
                            swal("Error", "Something Went Wrong", "error");
                        }
                    }
                });
            
            }
    
        });
    });

    $(document).on('click','.delete_supp_btn', function (e) {
      
    e.preventDefault();

    var id = $(this).val();

    //alert(id);

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
                $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'supplier_id':id,
                    'delete_supp_btn': true

                },
                success: function (response) {
                    if(response == 200)
                    {
                        
                        swal("Success", "Supplier Deleted Successfully", "success");
                        $("#supplier_table").load(location.href + " #supplier_table");
                    }
                    else if(response == 500)
                    {
                        swal("Error", "Something Went Wrong", "error");
                    }
                }
            });
          
         }
        });
    });


    $(document).on('click','.delete_emp_btn', function (e) {
      
        e.preventDefault();
    
        var id = $(this).val();
    
        //alert(id);
    
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                    $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'employee_id':id,
                        'delete_emp_btn': true
    
                    },
                    success: function (response) {
                        if(response == 200)
                        {
                            
                            swal("Success", "Employee Deleted Successfully", "success");
                            $("#employee_table").load(location.href + " #employee_table");
                        }
                        else if(response == 500)
                        {
                            swal("Error", "Something Went Wrong", "error");
                        }
                    }
                });
              
             }
            });
    });

     $(document).on('click','.delete_attend_btn', function (e) { 

            e.preventDefault();
    
            var id = $(this).val();
    
            //alert(id);
    
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                        $.ajax({
                        method: "POST",
                        url: "code.php",
                        data: {
                            'attendance_id':id,
                            'delete_attend_btn': true
    
                        },
                        success: function (response) {
                            if(response == 200)
                            {                              
                                swal("Success", "Attendance Deleted Successfully", "success");
                                $("#attendance_table").load(location.href + " #attendance_table");
                            }
                            else if(response == 500)
                            {
                                swal("Error", "Something Went Wrong", "error");
                            }
                        }
                    });
                  
                }
              });
       });
       
   $(document).on('click','.delete_leave_btn', function (e) { 

        e.preventDefault();

        var id = $(this).val();

        //alert(id);

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                    $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'leave_id':id,
                        'delete_leave_btn': true

                    },
                    success: function (response) {
                        if(response == 200)
                        {
                            
                            swal("Success", "Leave Deleted Successfully", "success");
                            $("#leave_table").load(location.href + " #leave_table");
                        }
                        else if(response == 500)
                        {
                            swal("Error", "Something Went Wrong", "error");
                        }
                    }
                });
              
            }
          });
   });

$(document).on('click','.delete_inv_btn', function (e) { 

    e.preventDefault();

    var id = $(this).val();

    //alert(id);

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
                $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'inventory_id':id,
                    'delete_inv_btn': true

                },
                success: function (response) {
                    if(response == 200)
                    {
                        
                        swal("Success", "Inventory Deleted Successfully", "success");
                        $("#inv_table").load(location.href + " #inv_table");
                    }
                    else if(response == 500)
                    {
                        swal("Error", "Something Went Wrong", "error");
                    }
                }
            });
          
        }
      });
});

$(document).on('click','.delete_stock_btn', function (e) { 

    e.preventDefault();

    var id = $(this).val();

    //alert(id);

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
                $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'stock_id':id,
                    'delete_stock_btn': true

                },
                success: function (response) {
                    if(response == 200)
                    {
                        
                        swal("Success", "Inventory Deleted Successfully", "success");
                        $("#stock_table").load(location.href + " #stock_table");
                    }
                    else if(response == 500)
                    {
                        swal("Error", "Something Went Wrong", "error");
                    }
                }
            });
          
        }
      });
});




























});
    