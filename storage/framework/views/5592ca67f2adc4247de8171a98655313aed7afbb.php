<? $info=DB::table('company_info')->first(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo e($info->company_name); ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="<?php echo e($info->company_name); ?>" name="description" />
    <meta content="<?php echo e($info->company_name); ?>" name="author" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="shortcut icon" type="image/png" href='<?php echo e(asset("images/company/ico/$info->company_icon")); ?>'>
   <link href="<?php echo e(asset('public/dashboard/ui/jquery-ui.css')); ?>" rel="stylesheet">
  <!-- Bootstrap core CSS-->
  <link href="<?php echo e(asset('public/dashboard/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('public/dashboard/vendor/bootstrap/css/bootstrap2.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('public/dashboard/vendor/bootstrap/css/bootstrap-theme.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('public/css/chosen.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('public/plugins/parsley/src/parsley.css')); ?>" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.min.css" rel="stylesheet" />
  <!-- Custom fonts for this template-->
  <link href="<?php echo e(asset('public/dashboard/vendor/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
  <!-- Page level plugin CSS-->
  <!-- Custom styles for this template-->
  <link href="<?php echo e(asset('public/dashboard/css/sb-admin.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('public/dashboard/css/custom.css')); ?>" rel="stylesheet">

