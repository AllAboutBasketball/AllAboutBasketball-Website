<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php'); 


?>

<div class="container">
    <div class="row ">
        <div class="col-md-12">
           <div class="card">
               <div class="card-header bg-info">
                   <h4 class="text-white">Supplier
                   <a href="add-supplier.php" class = "btn btn-warning float-end"><i class="fas fa-plus me-3"></i>Add Supplier</a> 
                   </h4>
               </div>
               <div class="card-body" id="supplier_table">
                   <table class="table table-bordered table-striped">
                       <thead>
                           <tr>
                               <th class="text-success fw-bold text-center">No.</th>
                               <th class="text-success fw-bold text-center" >Supplier Name</th>
                               <th class="text-success fw-bold text-center">Image</th>
                               <th class="text-success fw-bold text-center">Contact</th>
                               <th class="text-success fw-bold text-center">Email</th>
                               <th class="text-success fw-bold text-center">Status</th>
                               <th class="text-success fw-bold text-center">Date</th>
                               <th class="text-success fw-bold text-center">Action 1</th>
                               <th class="text-success fw-bold text-center">Action 2</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php
                                $supplier = getAll('supplier');

                                if(mysqli_num_rows($supplier) > 0)
                                {
                                    foreach($supplier as $item)
                                    {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $item['id']; ?></td>
                                            <td class="text-center"><?= $item['cname']; ?></td>
                                            <td class="text-center">
                                                <img src="../uploads/<?= $item['image']; ?>" width = "50px" height = "50px" alt="<?= $item['cname']; ?>">
                                            </td>
                                            <td class="text-center"><?= $item['phone']; ?></td>
                                            <td class="text-center"><?= $item['email']; ?></td>
                                            <td class="text-center"><?= $item['status']; ?></td>
                                            <td class="text-center"><?= $item['date_time']; ?></td>
                                            <td class="text-center">
                                                <a href="edit-supplier.php?id=<?= $item['id']; ?>" class="btn btn-success"><i class="fa fa-edit me-1"></i>Edit</a>
                                            </td>
                                            <td class="text-center">   
                                                <button type="button" class="btn btn-danger delete_supp_btn" value="<?= $item['id']; ?>"> <i class="fa fa-trash me-1"></i>Delete</button>   
                                            </td>
                                            
                                        </tr>

                                        <?php  

                                    }

                                }
                                else
                                {
                                    echo "No Records Found";
                                }
                           ?>
                           
                       </tbody>

                   </table>

               </div>
           </div>
        </div>
    </div>



    <?php include('includes/footer.php'); ?>