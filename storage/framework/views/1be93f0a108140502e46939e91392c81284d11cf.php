
<?php $__env->startSection('title', 'Gift Store'); ?>
<?php $__env->startSection('content'); ?>
<?php
$urlPrefix = urlPrefix();
if($urlPrefix != 'super-admin'){
$style="margin-bottom: 30px;";
}else{
$style="margin-bottom: 0px";
}
?>
<div class="main-content-wrap sidenav-open d-flex flex-column">
    <div class="main-content">


        <div class="breadcrumb">
            <h1>Gift Store</h1>
            <ul>
                <li><a href="#">Products</a></li>

            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>

        <form id="form" method="GET" action='<?php echo e(url("$urlPrefix/products")); ?>'>
            <div class="select-catory-container" style=" display : flex; align-items : center; position : absolute; z-index : 9999999;margin-bottom: 20px;">
                <label class="mr-3 mb-0">Select Category :</label>
                <select id='category' name="category" class="form-control" style="width: 200px; height : 27px; padding : 3px 0px 0px 5px">
                    <option value="">Select Category</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($d->category_id == $category->id): ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($child->id); ?>"><?php echo e('--'.$child->name); ?></option>
                    <?php $__currentLoopData = $child->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subchild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($subchild->id); ?>"><?php echo e('----'.$subchild->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="select-catory-container" style="display: flex;position: inherit;z-index: auto;margin-bottom: 20px;justify-content: center;
                      flex-direction: row;margin-left: 148px;align-items: center;align-content: initial;">
                <label class="mr-3 mb-0">Price :</label>
                <select id='price' name="price_order" class="form-control" style="width: 200px; height : 27px; padding : 3px 0px 0px 5px">
                    <option value="">Select</option>
                    <option value="price_low_to_high">Low to High</option>
                    <option value="price_high_to_low">High to Low</option>
                </select>
            </div>
        </form>

        <?php if($urlPrefix == 'super-admin'): ?>
        <a href='<?php echo e(url("$urlPrefix/add-prelisted-product")); ?>' type="button" class="btn btn-primary"> Add Products</a>
        <?php endif; ?>


        <?php if($urlPrefix == 'super-admin'): ?>
        <div class="table-responsive">
            <table id="table" class="tagitble table-bordered dt-responsive  nowrap w-100">
            </table>
        </div>
        <?php else: ?>


        <section class="product-cart">
            <div class="row list-grid" id="productsDiv">
                <!--             <?php if($data->count() > 0): ?>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $image = getImage(@$val->productDefaultImage->image, 'product');
                        if(getUrl() === 'super-admin/'){
                           $is_allow = 1; 
                           $is_delete = 1; 
                        }else{
                           $is_allow = 0;
                           $is_delete = 0;
                        }
                    ?>
                        <div class="list-item col-md-3">
                            <div class="card o-hidden mb-4 d-flex flex-column">
                                <div class="list-thumb d-flex">
                                    <a href="<?php echo e(url(getUrl().'view-product'.'/'.$val->id)); ?>" ><img alt="" src="<?php echo e($image); ?>" /></a>
                                </div>
                                <div class="flex-grow-1 d-bock">
                                    <div
                                        class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                                        <a class="w-40 w-sm-100" href="">
                                            <div class="item-title">
                                            <?php echo e($val->name); ?>

                                            </div>
                                        </a>
                                        
                                        <p class="m-0 text-muted text-small w-15 w-sm-100">
                                        ₹ <?php echo e($val->price); ?>

                                        </p>
                                        <a href="<?php echo e(url(getUrl().'campaigns')); ?>" class="btn btn-success ul-btn-raised--v2 m-1" style="color:white;"type="button">
                                              Send Gift
                                            </a>
                                            <a href="<?php echo e(url(getUrl().'view-product'.'/'.$val->id)); ?>" class="btn btn-outline-success ul-btn-raised--v2 m-1 float-right">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <span>No record found.</span>
            <?php endif; ?> -->
            </div>
        </section>
        <?php endif; ?>




    </div>
</div>

<script type="text/javascript">
    var table;
    var urlPrefix = "<?php echo e($urlPrefix); ?>";

    $(function() {
        var urlPrefix = "<?php echo e($urlPrefix); ?>";
        if (urlPrefix == 'super-admin') {
            getTable();
        } else {
            getProductsList();
        }

        // getListing('');
    });

    $('#category').on('change', function() {
        if (urlPrefix == 'client-admin') {
            // $('#form').trigger('submit');
            getProductsList();
        } else {
            table.draw();
        }
    });

    $('#price').on('change', function() {
        if (urlPrefix == 'client-admin') {
            // $('#form').trigger('submit');
            getProductsList();
        } else {
            table.draw();
        }
    });

    function getTable() {
        table = $('#table').DataTable({
            searching: true,
            processing: true,
            serverSide: true,
            lengthChange: false,
            ajax: {
                url: '<?php echo e(url("$urlPrefix/products")); ?>',
                type: "GET",
                data: function(d) {
                    d.category = $('#category').val(),
                        d.price_order = $('#price').val(),
                        d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    title: 'S.No.'
                },
                {
                    data: 'name',
                    name: 'name',
                    title: 'Product Name'
                },
                {
                    data: 'price',
                    name: 'price',
                    title: 'Price'
                },
                {
                    data: 'category',
                    name: 'category',
                    title: 'Category'
                },
                {
                    data: 'code',
                    name: 'code',
                    title: 'Product Code'
                },
                {
                    data: 'image',
                    name: 'image',
                    title: 'Image'
                },
                {
                    data: 'status',
                    name: 'status',
                    title: 'Status'
                },
                {
                    data: 'action',
                    name: 'action',
                    title: 'Action',
                    orderable: false,
                    searchable: false
                },
            ],
            error: function(xhr, error, code) {
                // window.location.href = url('client-admin/login');
            },
        });
    }

    // ajax loading
    function getProductsList() {
        var loader = `<div class="text-center mt-5">
                      <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                    </div>`;
        $("#productsDiv").html(loader);
        var url = '<?php echo e(url("$urlPrefix/all-products-render")); ?>';
        $.ajax({
            type: "GET",
            url: url,
            data: $('form').serialize(),
            success: function(response) {
                $("#productsDiv").html("");
                $("#productsDiv").html(response.html);
            }
        });
    }

    // //aAjax load content
    // var currentXhr = null;

    // function getListing(url) {
    //     if (url == '' || url == undefined) {
    //         url = '<?php echo e(url("$urlPrefix/all-products-render")); ?>';
    //     }
    //     // pageLoader('eventListing', 'show');
    //     // var searching = $("#event-search,#event-filter").serializeArray();
    //     // searching.push({
    //     //     name: '_token',
    //     //     value: '<?php echo e(csrf_token()); ?>'
    //     // });
    //     currentXhr = $.ajax({
    //         type: "GET",
    //         url: url,
    //         // data: searching,
    //         beforeSend: function() {
    //             if (currentXhr != null) {
    //                 currentXhr.abort();
    //                 currentXhr = null;
    //             }
    //         },
    //         success: function(response) {
    //             $("#productsDiv").html("");
    //             $("#productsDiv").html(response.html);
    //         },
    //         error: function(err) {
    //             //message('error', err);
    //             //getListing(url);
    //         },
    //         complete: function() {
    //             //                showButtonLoader('addButton', 'Save', 'enable');
    //             // getFilterClose();
    //         }
    //     });
    // }




    $('#category').change(function() {
        table.draw();
    });

    function deleteData(id) {
        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                type: "get",
                url: '<?php echo e(url("$urlPrefix/delete-product")); ?>/' + id,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        message('success', response.message);
                        table.ajax.reload(null, false);
                    } else {
                        message('error', response.message);
                    }
                }
            });
        }
    }

    function statusData(id) {
        if (confirm("Are you sure you want to change Status?")) {
            $.ajax({
                type: "get",
                url: "<?php echo e(url('super-admin/status-product')); ?>/" + id,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        message('success', response.message);
                        table.ajax.reload(null, false);
                    } else {
                        message('error', response.message);
                    }
                }
            });
        }
    }
</script>

<script>
    var optionValues = [];
    $('#category option').each(function() {
        // alert(this.value)
        if ($.inArray(this.value, optionValues) > -1) {
            $(this).remove()
            // $(this).hide();
        } else {
            optionValues.push(this.value);
        }
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ek-send\resources\views/products/index.blade.php ENDPATH**/ ?>