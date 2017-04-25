<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="Аватар" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> В сети</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <!--form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form-->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Меню</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>На сайт</span></a></li>
            <li class=""><a href="{{ url('admin/users') }}"><i class='fa fa-link'></i> <span>Пользователи</span></a></li>
            <li class=""><a href="{{ url('admin/brands') }}"><i class='fa fa-link'></i> <span>Бренды</span></a></li>
            <li class=""><a href="{{ url('admin/trainings') }}"><i class='fa fa-link'></i> <span>Тренинги</span></a></li>
            <li class=""><a href="{{ url('admin/lessons') }}"><i class='fa fa-link'></i> <span>Уроки</span></a></li>
            <li class=""><a href="{{ url('admin/lektors') }}"><i class='fa fa-link'></i> <span>Лекторы</span></a></li>
            <li class=""><a href="{{ url('admin/viewTrainings') }}"><i class='fa fa-link'></i> <span>Описание курсов</span></a></li>
            <li class=""><a href="{{ url('/admin/requests') }}"><i class='fa fa-link'></i> <span>Заявки</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
