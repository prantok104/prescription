<?php include('header.php');
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
        <div class="prbolem-show-area">
            <div class="pbl-display-edit">
                <div class="pbl-table-edit">
                    <h1 class="text-center text-uppercase">Edit Problem</h1>
                    <ul class="pbl-edit">
                        <?php
                            $showApps = "SELECT * FROM allproblem WHERE id ='". $_GET['pid']."'";
                            $showResult = mysqli_query($db,$showApps);
                            $showRow = mysqli_fetch_array($showResult);
                        ?>
                        <form action="" method="POST">
                           <select name="img" id="pblimg">
                               <option value="">Select Proiblem Icon</option>
                               <option value="1">Delta</option>
                               <option value="2">Rx</option>
                           </select>
                            <input type="hidden" id="pid" name="pid" value="<?php echo $showRow['id'];?>">
                            <input type="text" name="pblname" id="pblname" value="<?php echo $showRow['problem'];?>" class="form-control">
                            <button type="button" class="btn btn-primary" id="btn-update"><i class="fa fa-pencil-square-o"></i>Update </button>
                            <p id="edit-msg" class="bg-success"></p>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- Admin area end-->
</section>
<?php include('footer.php');?>
<!--Medecine Search by using Ajax -->
<script>
    $(document).ready(function(){
        $('#edit-msg').html('');
        $('#btn-update').click(function(){
            var pid = $('#pid').val();
            var pblimg = $('#pblimg').val();
            var pblname = $('#pblname').val();
            if(pblname!=''){
                $.ajax({
                    url: 'functions.php',
                    method:'POST',
                    data:{pid : pid, pblname : pblname , pblicon : pblimg},
                    success:function(data){
                        $('#edit-msg').html(data);
                    }
                });
            }
        });
    });
</script>
