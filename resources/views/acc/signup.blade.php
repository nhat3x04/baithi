@extends('layout.master')
@section('content')

<div class="container">
    <div id="content">
        <form action="{{ route('postsignin') }}" method="post" class="beta-form-checkout">
            @csrf
            <div class="row">
                <div class="col-sm-3"></div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{ $err }}<br>
                        @endforeach
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <h4>Đăng kí</h4>
                    <div class="space20">&nbsp;</div>

                    <div class="form-block">
                        <label for="email">Email address*</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-block">
                        <label for="fullname">Fullname*</label>
                        <input type="text" id="fullname" name="fullname" required>
                    </div>

                    <div class="form-block">
                        <label for="address">Address*</label>
                        <input type="text" id="address" name="address" required>
                    </div>

                    <div class="form-block">
                        <label for="phone">Phone*</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>
                    <div class="form-block">
                        <label for="password">Password*</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-block">
                        <label for="repassword">Re password*</label>
                        <input type="password" id="repassword" name="repassword" required>
                    </div>
                    <div class="form-block">
                        <label for="role">Role*</label>
                        <select id="role" name="role" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-block">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
    </div>
</div>

@endsection

<!--customjs-->
<script type="text/javascript">
    $(function() {
        // this will get the full URL at the address bar
        var url = window.location.href;

        // passes on every "a" tag
        $(".main-menu a").each(function() {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest("li").addClass("active");
                $(this).parents('li').addClass('parent-active');
            }
        });
    });
</script>
<script>
    jQuery(document).ready(function($) {
        'use strict';

        // color box

        //color
        jQuery('#style-selector').animate({
            left: '-213px'
        });

        jQuery('#style-selector a.close').click(function(e){
            e.preventDefault();
            var div = jQuery('#style-selector');
            if (div.css('left') === '-213px') {
                jQuery('#style-selector').animate({
                    left: '0'
                });
                jQuery(this).removeClass('icon-angle-left');
                jQuery(this).addClass('icon-angle-right');
            } else {
                jQuery('#style-selector').animate({
                    left: '-213px'
                });
                jQuery(this).removeClass('icon-angle-right');
                jQuery(this).addClass('icon-angle-left');
            }
        });
    });
</script>
</body>
</html>
