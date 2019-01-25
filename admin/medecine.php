<?php 
    include('header.php');
    include('../db.php');
?>
<header class="admin-bar-areas">
    <a href="../index.php"><i class="fa fa-bars"></i> MENU</a>
</header>
<section class="admin-area-start">
    <div class="admin-menu-area">
        <?php include('menu.php');?>
    </div><!-- Admin menu end-->
    <div class="admin-area">
            <div class="col-md-3">
                <div class="both-of-medecine add-medecine">
                    <div class="add-medecine-icon">
                        <a href="" data-toggle="modal" data-target="#exampleModalLong"> <i class="fa fa-plus"></i> Add Medecine</a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="both-of-medecine edit-medecine">
                    <form action="" method="POST">
                        <input type="text" name="medecine-search" id="medecine-search" placeholder="Medecine Name" class="form-control">
                        <div class="medecine-list patient-table">
                            <table class="table table-responsive table-hover table-striped table-bordered text-center">
                                <thead class="bg-danger">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Medecine Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                <?php
                                    $showmedecine = "SELECT * FROM medecine ORDER BY id DESC";
                                    $showmedecineresult = mysqli_query($db,$showmedecine);
                                    $idcount = 1;
                                    while($showmedecinerow = mysqli_fetch_array($showmedecineresult)){
                                        echo '
                                        <tr>
                                            <td>'.$idcount++.'</td>
                                            <td>'.$showmedecinerow['category'].'</td>
                                            <td>'.$showmedecinerow['name'].'</td>
                                        ';
                                    ?>
                                    <td>
                                        <a href="editmedecine.php ? editmedecineid=<?php echo $showmedecinerow['id'];?>" class="btn btn-primary btn-xs" data-toggle="modal"><i class="fa fa-pencil-square-o"></i>Edit</a>
                                        <input type="hidden" name="deleteid" id="deleteid" value="<?php echo $showmedecinerow['id'];?>">
                                        <a href="functions.php ? medecinedeleteid=<?php echo $showmedecinerow['id'];?>" id="medecine-delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
                                    </td>
                                    <?php echo '</tr> ';}?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
    </div><!-- Admin area end-->
</section>

<!--Add Medecine Modal area start-->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-plus"></i> Medecine </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-form">
                    <form action="" method="POST" class="add-medecine">
                        <select name="medecine-category" id="medecine-add-category" class="medecine-category">
                            <option value="all">Select Medecine Category</option>
                            <option value="Tablet">Tablet</option>
                            <option value="capsule">capsule</option>
                            <option value="ointment">ointment</option>
                            <option value="sympoo">sympoo</option>
                            <option value="syrup">syrup</option>
                        </select>
                        <input type="text" name="medecine-name" id="add-medecine-name" placeholder="Medecine Name" class="form-control">
                        <button type="button" class="btn btn-sm btn-primary" id="medecine-insert"> <i class="fa fa-plus"></i> Add Medecine</button>
                    </form>
                </div>
                <p class="show-msg"></p>
            </div>
            <div class="modal-footer">
                <p class="bg-danger text-center">All * mark shuld be fill up ! </p>
            </div>
        </div>
    </div>
</div>
<!--Add Medecine Modal area end-->

<?php include('footer.php');?>
<!--Medecine Edit and Delete Ajax Code -->
<script>
    $(document).ready(function(){
        // Insert Medecine Code in Ajax
        $('#medecine-insert').click(function(){
            var addname = $('#add-medecine-name').val();
            var addcategory = $('#medecine-add-category').val();
           
            $.ajax({
                url:'functions.php',
                method:'POST',
                data:{ addname : addname , addcategory : addcategory},
                success:function(data){
                    $('.show-msg').html(data);
                }
            });

        });
    });
</script>
<!--Medecine Search by using Ajax -->
<script>
    $(document).ready(function(){
        $('#medecine-search').keyup(function(){
            var medecinenames = $('#medecine-search').val();
            if(medecinenames!=''){
                $.ajax({
                    url: 'functions.php',
                    method:'POST',
                    data:{medecinenames:medecinenames},
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            }
        });
    });
</script>

