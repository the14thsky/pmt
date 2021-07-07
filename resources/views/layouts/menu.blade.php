
<li class="treeview administration {{ Request::is('users*', 'department*', 'administration*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-cog"></i> <span>Administration</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}"><i class="fa fa-user"></i><span> Users</span></a>
        </li>



        <li class="{{ Request::is('administration/orgRoles*') ? 'active' : '' }}">
            <a href="{{ route('administration.orgRoles.index') }}"><i class="fa fa-graduation-cap"></i><span> Org Roles</span></a>
        </li>

        <li class="{{ Request::is('administration/departments*') ? 'active' : '' }}">
            <a href="{{ route('administration.departments.index') }}"><i class="fa fa-cubes"></i><span> Departments</span></a>
        </li>

        <li class="{{ Request::is('administration/budgetTemplates*') ? 'active' : '' }}">
            <a href="{{ route('administration.budgetTemplates.index') }}"><i class="fa fa-edit"></i><span>Budget Templates</span></a>
        </li>

        <li class="{{ Request::is('administration/deliverableTemplates*') ? 'active' : '' }}">
            <a href="{{ route('administration.deliverableTemplates.index') }}"><i class="fa fa-edit"></i><span>Deliverable Templates</span></a>
        </li>

        <li class="{{ Request::is('administration/holidays*') ? 'active' : '' }}">
            <a href="{{ route('administration.holidays.index') }}"><i class="fa fa-edit"></i><span>Holidays</span></a>
        </li>

    </ul>

</li>

<li class="treeview sales {{ Request::is('sales*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-money"></i> <span> Sales</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('sales/customers*') ? 'active' : '' }}">
            <a href="{{ route('sales.customers.index') }}"><i class="fa fa-user"></i><span> Customers</span></a>
        </li>


        <li class="{{ Request::is('sales/opportunities*') ? 'active' : '' }}">
            <a href="{{ route('sales.opportunities.index') }}"><i class="fa fa-handshake-o"></i><span> Opportunities</span></a>
        </li>

        <li class="{{ Request::is('sales/projects*') ? 'active' : '' }}">
            <a href="{{ route('sales.projects.index') }}"><i class="fa fa-file"></i><span> Projects</span></a>
        </li>


    </ul>
</li>
















