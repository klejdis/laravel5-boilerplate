@extends('backend.layouts.auth')

<section class="content">
    <div class="error-page">
        <h2 class="headline text-yellow"><i class="fa fa-frown-o" aria-hidden="true"></i>  </h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops!</h3>

            <p>
            {{$e->getMessage()}}
            </p>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
    </div></section>