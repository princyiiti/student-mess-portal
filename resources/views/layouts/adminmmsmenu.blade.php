 <li class="nav-item has-treeview {!! classActivePath(2,'brand') !!} {!! classActivePath(2,'items') !!} {!! classActivePath(2,'categorys') !!}{!! classActivePath(2,'denominations') !!}{!! classActivePath(2,'subcategorys') !!}">
                    <a href="{!! route('home') !!}" class="nav-link {!! classActiveSegment(2,'brand') !!} {!! classActiveSegment(2,'items') !!}  {!! classActiveSegment(2,'categorys') !!}{!! classActiveSegment(2,'subcategorys') !!}
                    {!! classActiveSegment(2,'denominations') !!}">
                        <i class="nav-icon fas fa fa-barcode"></i>
                        <p>
                            Item Setting
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                          <li class="nav-item">
                    <a href="{{ url('/admin/items') }}" class="nav-link {!! classActiveSegment(2, 'items') !!}">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p class="text">Items</p>
                    </a>
                </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/categorys') }}" class="nav-link {!! classActiveSegment(2, 'categorys') !!}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                         <li class="nav-item">
                                <li class="nav-item">
                    <a href="{{ url('/admin/denominations') }}" class="nav-link {!! classActiveSegment(2, 'denominations') !!}">
                         <i class="fa fa-circle-o nav-icon"></i>
                        <p class="text">Denominations</p>
                    </a>
                </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/subcategorys') }}" class="nav-link {!! classActiveSegment(2, 'subcategorys') !!}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Subcategories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/brand') }}" class="nav-link {!! classActiveSegment(2, 'brand') !!}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Brand</p>
                            </a>
                        </li>
                    </ul>
                </li>
              
                <!--===== Puchase Indent Work ===========-->

                <li class="nav-item has-treeview {!! classActivePath(2,'purchase_indent') !!}  {!! classActivePath(2, 'draftpurchase') !!} ">
                    <a href="{!! route('home') !!}" class="nav-link {!! classActiveSegment(2,'purchase_indent') !!} {!! classActiveSegment(2,'draftpurchase') !!}">
                        <i class="nav-icon fas fa fa-product-hunt"></i><p>Purchase Indent
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                            <a href="{{ url('/admin/purchase_indent/create') }}" class="nav-link {!! classActiveSegment(2, 'purchase_indent') !!}">
                               <i class="fa fa-circle-o nav-icon"></i>
                                <span class="navsub">Add New Purchase Indent </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/purchase_indent') }}" class="nav-link {!! classActiveSegment(2, 'purchase_indent') !!} ">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p class="text">List Purchase Indent</p>
                            </a>
                        </li>                          
                        <!-- <li class="nav-item">
                            <a href="{{ url('/admin/draftpurchase') }}" class="nav-link {!! classActiveSegment(2, 'draftpurchase') !!}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p class="text">Draft Purchase Order</p>
                            </a>
                        </li> -->
                   
                    </ul>
                </li>
                <!--==========End Purchase indent menu ================-->
 <li class="nav-item has-treeview {!! classActivePath(2,'department') !!}  {!! classActivePath(2, 'designation') !!} {!! classActivePath(2, 'supplier') !!} ">
                    <a href="{!! route('home') !!}" class="nav-link {!! classActiveSegment(2,'department') !!} {!! classActiveSegment(2,'designation') !!}{!! classActiveSegment(2,'supplier') !!}">
                        <i class="nav-icon fas fa fa-users"></i><p>User Management
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
              
                    <a href="{{ url('/admin/department') }}" class="nav-link {!! classActiveSegment(2, 'department') !!}">
                       <i class="fa fa-circle-o nav-icon"></i>
                        <p class="text">Departments</p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ url('/admin/designation') }}" class="nav-link {!! classActiveSegment(2, 'designation') !!}">
                      <i class="fa fa-circle-o nav-icon"></i>
                        <p class="text">Designations</p>
                    </a>
                </li>
                     <li class="nav-item">
                            <a href="{{ url('/admin/supplier') }}" class="nav-link {!! classActiveSegment(2, 'supplier') !!}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p class="text">suppliers </p>
                            </a>
                        </li>
            </ul>
        </li>
         <!--===== User Management End ===========-->
<li class="nav-item ">
     <a href="{{url('/admin/assignedindent')}}" class="nav-link {!! classActiveSegment(2,'assignedindent') !!} "><i class="nav-icon fas fa fa-tasks"></i><p>Assigned Indent
      </p></a>
</li>
               