

<?php $__env->startSection('title', 'Medicine Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-info-circle"></i> Medicine Details
                    </h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Medicine Name</dt>
                        <dd class="col-sm-8"><?php echo e($medicine->medicine_name); ?></dd>

                        <dt class="col-sm-4">Type</dt>
                        <dd class="col-sm-8"><?php echo e($medicine->type); ?></dd>

                        <dt class="col-sm-4">Stock</dt>
                        <dd class="col-sm-8"><?php echo e($medicine->stock); ?></dd>

                        <dt class="col-sm-4">Price</dt>
                        <dd class="col-sm-8">Rp<?php echo e(number_format($medicine->price, 2, ',', '.')); ?></dd>

                        <?php if(!empty($medicine->description)): ?>
                        <dt class="col-sm-4">Description</dt>
                        <dd class="col-sm-8"><?php echo e($medicine->description); ?></dd>
                        <?php endif; ?>

                        <?php if(!empty($medicine->expiry_date)): ?>
                        <dt class="col-sm-4">Expiry Date</dt>
                        <dd class="col-sm-8"><?php echo e(\Carbon\Carbon::parse($medicine->expiry_date)->format('d M Y')); ?></dd>
                        <?php endif; ?>

                        <dt class="col-sm-4">Created At</dt>
                        <dd class="col-sm-8"><?php echo e($medicine->created_at->format('d M Y H:i')); ?></dd>

                        <dt class="col-sm-4">Updated At</dt>
                        <dd class="col-sm-8"><?php echo e($medicine->updated_at->format('d M Y H:i')); ?></dd>
                    </dl>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?php echo e(route('medicines.index')); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                        <?php if(auth()->user()->role == 'apoteker'): ?>
                        <div>
                            <a href="<?php echo e(route('medicines.edit', $medicine)); ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="<?php echo e(route('medicines.destroy', $medicine)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this medicine?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH Z:\room\klinik_fazri\resources\views/medicines/show.blade.php ENDPATH**/ ?>