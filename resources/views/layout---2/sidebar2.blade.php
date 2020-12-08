<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
      <div class="sidebar-brand-icon rotate-n-15">
        @if($general_setting->site_logo)<img src="{{url('public/logo', $general_setting->site_logo)}}" >&nbsp;&nbsp;@endif
      </div>
      <div class="sidebar-brand-text mx-3">{{$general_setting->site_title}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">



               
          <li><a href="{{url('/')}}"> <i class="dripicons-meter"></i><span>{{ __('file.dashboard') }}</span></a></li>
  
          <li><a href="#product" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-list"></i><span>{{__('file.product')}}</span><span></a>
            <ul id="product" class="collapse list-unstyled ">
              <li id="category-menu"><a href="{{route('category.index')}}">{{__('file.category')}}</a></li>
              @if($index_permission_active)
              <li id="product-list-menu"><a href="{{route('products.index')}}">{{__('file.product_list')}}</a></li>
              <?php 
                $add_permission = DB::table('permissions')->where('name', 'products-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="product-create-menu"><a href="{{route('products.create')}}">{{__('file.add_product')}}</a></li>
              @endif
              @endif
              @if($print_barcode_active)
              <li id="printBarcode-menu"><a href="{{route('product.printBarcode')}}">{{__('file.print_barcode')}}</a></li>
              @endif
              @if($adjustment_active)
                <li id="adjustment-list-menu"><a href="{{route('qty_adjustment.index')}}">{{trans('file.Adjustment List')}}</a></li>
                <li id="adjustment-create-menu"><a href="{{route('qty_adjustment.create')}}">{{trans('file.Add Adjustment')}}</a></li>
              @endif
              @if($stock_count_active)
                <li id="stock-count-menu"><a href="{{route('stock-count.index')}}">{{trans('file.Stock Count')}}</a></li>
              @endif
            </ul>
          </li>
          <?php 
            $index_permission = DB::table('permissions')->where('name', 'purchases-index')->first();
              $index_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();
          ?>
          @if($index_permission_active)
          <li><a href="#purchase" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-card"></i><span>{{trans('file.Purchase')}}</span></a>
            <ul id="purchase" class="collapse list-unstyled ">
              <li id="purchase-list-menu"><a href="{{route('purchases.index')}}">{{trans('file.Purchase List')}}</a></li>
              <?php 
                $add_permission = DB::table('permissions')->where('name', 'purchases-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="purchase-create-menu"><a href="{{route('purchases.create')}}">{{trans('file.Add Purchase')}}</a></li>
              <li id="purchase-import-menu"><a href="{{url('purchases/purchase_by_csv')}}">{{trans('file.Import Purchase By CSV')}}</a></li>
              @endif
            </ul>
          </li>
          @endif
          <?php 
            $index_permission = DB::table('permissions')->where('name', 'sales-index')->first();
            $index_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();
  
            $gift_card_permission = DB::table('permissions')->where('name', 'gift_card')->first();
            $gift_card_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $gift_card_permission->id],
                    ['role_id', $role->id]
                ])->first();
  
            $coupon_permission = DB::table('permissions')->where('name', 'coupon')->first();
            $coupon_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $coupon_permission->id],
                    ['role_id', $role->id]
                ])->first();
          ?>
          
          <li><a href="#sale" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-cart"></i><span>{{trans('file.Sale')}}</span></a>
            <ul id="sale" class="collapse list-unstyled ">
              @if($index_permission_active)
              <li id="sale-list-menu"><a href="{{route('sales.index')}}">{{trans('file.Sale List')}}</a></li>
              <?php 
                $add_permission = DB::table('permissions')->where('name', 'sales-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li><a href="{{route('sale.pos')}}">POS</a></li>
              <li id="sale-create-menu"><a href="{{route('sales.create')}}">{{trans('file.Add Sale')}}</a></li>
              <li id="sale-import-menu"><a href="{{url('sales/sale_by_csv')}}">{{trans('file.Import Sale By CSV')}}</a></li>
              @endif
              @endif
              @if($gift_card_permission_active)
              <li id="gift-card-menu"><a href="{{route('gift_cards.index')}}">{{trans('file.Gift Card List')}}</a> </li>
              @endif
              @if($coupon_permission_active)
              <li id="coupon-menu"><a href="{{route('coupons.index')}}">{{trans('file.Coupon List')}}</a> </li>
              @endif
              <li id="delivery-menu"><a href="{{route('delivery.index')}}">{{trans('file.Delivery List')}}</a></li>
            </ul>
          </li>
          <?php 
            $index_permission = DB::table('permissions')->where('name', 'expenses-index')->first();
            $index_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();
          ?>
          @if($index_permission_active)
          <li><a href="#expense" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-wallet"></i><span>{{trans('file.Expense')}}</span></a>
            <ul id="expense" class="collapse list-unstyled ">
              <li id="exp-cat-menu"><a href="{{route('expense_categories.index')}}">{{trans('file.Expense Category')}}</a></li>
              <li id="exp-list-menu"><a href="{{route('expenses.index')}}">{{trans('file.Expense List')}}</a></li>
              <?php 
                $add_permission = DB::table('permissions')->where('name', 'expenses-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li><a id="add-expense" href=""> {{trans('file.Add Expense')}}</a></li>
              @endif
            </ul>
          </li>
          @endif
          <?php 
            $index_permission = DB::table('permissions')->where('name', 'quotes-index')->first();
            $index_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();
          ?>
          @if($index_permission_active)
          <li><a href="#quotation" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document"></i><span>{{trans('file.Quotation')}}</span><span></a>
            <ul id="quotation" class="collapse list-unstyled ">
              <li id="quotation-list-menu"><a href="{{route('quotations.index')}}">{{trans('file.Quotation List')}}</a></li>
              <?php 
                $add_permission = DB::table('permissions')->where('name', 'quotes-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="quotation-create-menu"><a href="{{route('quotations.create')}}">{{trans('file.Add Quotation')}}</a></li>
              @endif
            </ul>
          </li>
          @endif
          <?php 
            $index_permission = DB::table('permissions')->where('name', 'transfers-index')->first();
            $index_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();
          ?>
          @if($index_permission_active)
          <li><a href="#transfer" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-export"></i><span>{{trans('file.Transfer')}}</span></a>
            <ul id="transfer" class="collapse list-unstyled ">
              <li id="transfer-list-menu"><a href="{{route('transfers.index')}}">{{trans('file.Transfer List')}}</a></li>
              <?php 
                $add_permission = DB::table('permissions')->where('name', 'transfers-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="transfer-create-menu"><a href="{{route('transfers.create')}}">{{trans('file.Add Transfer')}}</a></li>
              <li id="transfer-import-menu"><a href="{{url('transfers/transfer_by_csv')}}">{{trans('file.Import Transfer By CSV')}}</a></li>
              @endif
            </ul>
          </li>
          @endif
          
          <li><a href="#return" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-archive"></i><span>{{trans('file.return')}}</span></a>
            <ul id="return" class="collapse list-unstyled ">
              <?php 
                $index_permission = DB::table('permissions')->where('name', 'returns-index')->first();
                $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
              ?>
              @if($index_permission_active)
              <li id="sale-return-menu"><a href="{{route('return-sale.index')}}">{{trans('file.Sale')}}</a></li>
              @endif
              <?php 
                $index_permission = DB::table('permissions')->where('name', 'purchase-return-index')->first();
                $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
              ?>
              @if($index_permission_active)
              <li id="purchase-return-menu"><a href="{{route('return-purchase.index')}}">{{trans('file.Purchase')}}</a></li>
              @endif
            </ul>
          </li>
          <?php 
            $index_permission = DB::table('permissions')->where('name', 'account-index')->first();
            $index_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();
  
            $money_transfer_permission = DB::table('permissions')->where('name', 'money-transfer')->first();
            $money_transfer_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $money_transfer_permission->id],
                    ['role_id', $role->id]
                ])->first();
  
            $balance_sheet_permission = DB::table('permissions')->where('name', 'balance-sheet')->first();
            $balance_sheet_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $balance_sheet_permission->id],
                    ['role_id', $role->id]
                ])->first();
  
            $account_statement_permission = DB::table('permissions')->where('name', 'account-statement')->first();
            $account_statement_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $account_statement_permission->id],
                    ['role_id', $role->id]
                ])->first();
  
          ?>
          @if($index_permission_active || $balance_sheet_permission_active || $account_statement_permission_active)
          <li class=""><a href="#account" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span>{{trans('file.Accounting')}}</span></a>
            <ul id="account" class="collapse list-unstyled ">
              @if($index_permission_active)
              <li id="account-list-menu"><a href="{{route('accounts.index')}}">{{trans('file.Account List')}}</a></li>
              <li><a id="add-account" href="">{{trans('file.Add Account')}}</a></li>
              @endif
              @if($money_transfer_permission_active)
              <li id="money-transfer-menu"><a href="{{route('money-transfers.index')}}">{{trans('file.Money Transfer')}}</a></li>
              @endif
              @if($balance_sheet_permission_active)
              <li id="balance-sheet-menu"><a href="{{route('accounts.balancesheet')}}">{{trans('file.Balance Sheet')}}</a></li>
              @endif
              @if($account_statement_permission_active)
              <li id="account-statement-menu"><a id="account-statement" href="">{{trans('file.Account Statement')}}</a></li>
              @endif
            </ul>
          </li>
          @endif
          <?php 
            $department = DB::table('permissions')->where('name', 'department')->first();
            $department_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $department->id],
                    ['role_id', $role->id]
                ])->first();
            $index_employee = DB::table('permissions')->where('name', 'employees-index')->first();
            $index_employee_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_employee->id],
                    ['role_id', $role->id]
                ])->first();
            $attendance = DB::table('permissions')->where('name', 'attendance')->first();
            $attendance_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $attendance->id],
                    ['role_id', $role->id]
                ])->first();
            $payroll = DB::table('permissions')->where('name', 'payroll')->first();
            $payroll_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $payroll->id],
                    ['role_id', $role->id]
                ])->first();
          ?>
          
          <li class=""><a href="#hrm" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user-group"></i><span>HRM</span></a>
            <ul id="hrm" class="collapse list-unstyled ">
              @if($department_active)
              <li id="dept-menu"><a href="{{route('departments.index')}}">{{trans('file.Department')}}</a></li>
              @endif
              @if($index_employee_active)
              <li id="employee-menu"><a href="{{route('employees.index')}}">{{trans('file.Employee')}}</a></li>
              @endif
              @if($attendance_active)
              <li id="attendance-menu"><a href="{{route('attendance.index')}}">{{trans('file.Attendance')}}</a></li>
              @endif
              @if($payroll_active)
              <li id="payroll-menu"><a href="{{route('payroll.index')}}">{{trans('file.Payroll')}}</a></li>
              @endif
              <li id="holiday-menu"><a href="{{route('holidays.index')}}">{{trans('file.Holiday')}}</a></li>
            </ul>
          </li>
          
          <li><a href="#people" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user"></i><span>{{trans('file.People')}}</span></a>
            <ul id="people" class="collapse list-unstyled ">
              <?php $index_permission_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'users-index'],
                      ['role_id', $role->id] ])->first();
              ?>
              @if($index_permission_active)
              <li id="user-list-menu"><a href="{{route('user.index')}}">{{trans('file.User List')}}</a></li>
              <?php $add_permission_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'users-add'],
                      ['role_id', $role->id] ])->first();
              ?>
              @if($add_permission_active)
              <li id="user-create-menu"><a href="{{route('user.create')}}">{{trans('file.Add User')}}</a></li>
              @endif
              @endif
              <?php 
                $index_permission = DB::table('permissions')->where('name', 'customers-index')->first();
                $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
              ?>
              @if($index_permission_active)
              <li id="customer-list-menu"><a href="{{route('customer.index')}}">{{trans('file.Customer List')}}</a></li>
              <?php 
                $add_permission = DB::table('permissions')->where('name', 'customers-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="customer-create-menu"><a href="{{route('customer.create')}}">{{trans('file.Add Customer')}}</a></li>
              @endif
              @endif
              <?php 
                $index_permission = DB::table('permissions')->where('name', 'billers-index')->first();
                $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
              ?>
              @if($index_permission_active)
              <li id="biller-list-menu"><a href="{{route('biller.index')}}">{{trans('file.Biller List')}}</a></li>
              <?php 
                $add_permission = DB::table('permissions')->where('name', 'billers-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="biller-create-menu"><a href="{{route('biller.create')}}">{{trans('file.Add Biller')}}</a></li>
              @endif
              @endif
              <?php 
                $index_permission = DB::table('permissions')->where('name', 'suppliers-index')->first();
                $index_permission_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $index_permission->id],
                        ['role_id', $role->id]
                    ])->first();
              ?>
              @if($index_permission_active)
              <li id="supplier-list-menu"><a href="{{route('supplier.index')}}">{{trans('file.Supplier List')}}</a></li>
              <?php 
                $add_permission = DB::table('permissions')->where('name', 'suppliers-add')->first();
                $add_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $add_permission->id],
                    ['role_id', $role->id]
                ])->first();
              ?>
              @if($add_permission_active)
              <li id="supplier-create-menu"><a href="{{route('supplier.create')}}">{{trans('file.Add Supplier')}}</a></li>
              @endif
              @endif
            </ul>
          </li>
          <li><a href="#report" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document-remove"></i><span>{{trans('file.Reports')}}</span></a>
            <?php
              $profit_loss_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'profit-loss'],
                      ['role_id', $role->id] ])->first();
              $best_seller_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'best-seller'],
                      ['role_id', $role->id] ])->first();
              $warehouse_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'warehouse-report'],
                      ['role_id', $role->id] ])->first();
              $warehouse_stock_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'warehouse-stock-report'],
                      ['role_id', $role->id] ])->first();
              $product_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'product-report'],
                      ['role_id', $role->id] ])->first();
              $daily_sale_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'daily-sale'],
                      ['role_id', $role->id] ])->first();
              $monthly_sale_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'monthly-sale'],
                      ['role_id', $role->id]])->first();
              $daily_purchase_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'daily-purchase'],
                      ['role_id', $role->id] ])->first();
              $monthly_purchase_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'monthly-purchase'],
                      ['role_id', $role->id] ])->first();
              $purchase_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'purchase-report'],
                      ['role_id', $role->id] ])->first();
              $sale_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'sale-report'],
                      ['role_id', $role->id] ])->first();
              $payment_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'payment-report'],
                      ['role_id', $role->id] ])->first();
              $product_qty_alert_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'product-qty-alert'],
                      ['role_id', $role->id] ])->first();
              $user_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'user-report'],
                      ['role_id', $role->id] ])->first();
  
              $customer_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'customer-report'],
                      ['role_id', $role->id] ])->first();
              $supplier_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'supplier-report'], 
                      ['role_id', $role->id] ])->first();
              $due_report_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                      ['permissions.name', 'due-report'],
                      ['role_id', $role->id] ])->first();
            ?>
            <ul id="report" class="collapse list-unstyled ">
              @if($profit_loss_active)
              <li id="profit-loss-report-menu">
                {!! Form::open(['route' => 'report.profitLoss', 'method' => 'post', 'id' => 'profitLoss-report-form']) !!}
                <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <a id="profitLoss-link" href="">{{trans('file.Summary Report')}}</a>
                {!! Form::close() !!}
              </li>
              @endif
              @if($best_seller_active)
              <li id="best-seller-report-menu">
                <a href="{{url('report/best_seller')}}">{{trans('file.Best Seller')}}</a>
              </li>
              @endif
              @if($product_report_active)
              <li id="product-report-menu">
                {!! Form::open(['route' => 'report.product', 'method' => 'post', 'id' => 'product-report-form']) !!}
                <input type="hidden" name="start_date" value="1988-04-18" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <input type="hidden" name="warehouse_id" value="0" />
                <a id="report-link" href="">{{trans('file.Product Report')}}</a>
                {!! Form::close() !!}
              </li>
              @endif
              @if($daily_sale_active)
              <li id="daily-sale-report-menu">
                <a href="{{url('report/daily_sale/'.date('Y').'/'.date('m'))}}">{{trans('file.Daily Sale')}}</a>
              </li>
              @endif
              @if($monthly_sale_active)
              <li id="monthly-sale-report-menu">
                <a href="{{url('report/monthly_sale/'.date('Y'))}}">{{trans('file.Monthly Sale')}}</a>
              </li>
              @endif
              @if($daily_purchase_active)
              <li id="daily-purchase-report-menu">
                <a href="{{url('report/daily_purchase/'.date('Y').'/'.date('m'))}}">{{trans('file.Daily Purchase')}}</a>
              </li>
              @endif
              @if($monthly_purchase_active)
              <li id="monthly-purchase-report-menu">
                <a href="{{url('report/monthly_purchase/'.date('Y'))}}">{{trans('file.Monthly Purchase')}}</a>
              </li>
              @endif
              @if($sale_report_active)
              <li id="sale-report-menu">
                {!! Form::open(['route' => 'report.sale', 'method' => 'post', 'id' => 'sale-report-form']) !!}
                <input type="hidden" name="start_date" value="1988-04-18" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <input type="hidden" name="warehouse_id" value="0" />
                <a id="sale-report-link" href="">{{trans('file.Sale Report')}}</a>
                {!! Form::close() !!}
              </li>
              @endif
              @if($payment_report_active)
              <li id="payment-report-menu">
                {!! Form::open(['route' => 'report.paymentByDate', 'method' => 'post', 'id' => 'payment-report-form']) !!}
                <input type="hidden" name="start_date" value="1988-04-18" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <a id="payment-report-link" href="">{{trans('file.Payment Report')}}</a>
                {!! Form::close() !!}
              </li>
              @endif
              @if($purchase_report_active)
              <li id="purchase-report-menu">
                {!! Form::open(['route' => 'report.purchase', 'method' => 'post', 'id' => 'purchase-report-form']) !!}
                <input type="hidden" name="start_date" value="1988-04-18" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <input type="hidden" name="warehouse_id" value="0" />
                <a id="purchase-report-link" href="">{{trans('file.Purchase Report')}}</a>
                {!! Form::close() !!}
              </li>
              @endif
              @if($warehouse_report_active)
              <li id="warehouse-report-menu">
                <a id="warehouse-report-link" href="">{{trans('file.Warehouse Report')}}</a>
              </li>
              @endif
              @if($warehouse_stock_report_active)
              <li id="warehouse-stock-report-menu">
                <a href="{{route('report.warehouseStock')}}">{{trans('file.Warehouse Stock Chart')}}</a>
              </li>
              @endif
              @if($product_qty_alert_active)
              <li id="qtyAlert-report-menu">
                <a href="{{route('report.qtyAlert')}}">{{trans('file.Product Quantity Alert')}}</a>
              </li>
              @endif
              @if($user_report_active)
              <li id="user-report-menu">
                <a id="user-report-link" href="">{{trans('file.User Report')}}</a>
              </li>
              @endif
              @if($customer_report_active)
              <li id="customer-report-menu">
                <a id="customer-report-link" href="">{{trans('file.Customer Report')}}</a>
              </li>
              @endif
              @if($supplier_report_active)
              <li id="supplier-report-menu">
                <a id="supplier-report-link" href="">{{trans('file.Supplier Report')}}</a>
              </li>
              @endif
              @if($due_report_active)
              <li id="due-report-menu">
                {!! Form::open(['route' => 'report.dueByDate', 'method' => 'post', 'id' => 'due-report-form']) !!}
                <input type="hidden" name="start_date" value="1988-04-18" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <a id="due-report-link" href="">{{trans('file.Due Report')}}</a>
                {!! Form::close() !!}
              </li>
              @endif
            </ul>
          </li>
          <li><a href="#setting" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-gear"></i><span>{{trans('file.settings')}}</span></a>
            <ul id="setting" class="collapse list-unstyled ">
             
              @if($role->id <= 2)
              <li id="role-menu"><a href="{{route('role.index')}}">{{trans('file.Role Permission')}}</a></li>
              @endif
              @if($warehouse_permission_active)
              <li id="warehouse-menu"><a href="{{route('warehouse.index')}}">{{trans('file.Warehouse')}}</a></li>
              @endif
              @if($customer_group_permission_active)
              <li id="customer-group-menu"><a href="{{route('customer_group.index')}}">{{trans('file.Customer Group')}}</a></li>
              @endif
              @if($brand_permission_active)
              <li id="brand-menu"><a href="{{route('brand.index')}}">{{trans('file.Brand')}}</a></li>
              @endif
              @if($unit_permission_active)
              <li id="unit-menu"><a href="{{route('unit.index')}}">{{trans('file.Unit')}}</a></li>
              @endif
              @if($tax_permission_active)
              <li id="tax-menu"><a href="{{route('tax.index')}}">{{trans('file.Tax')}}</a></li>
              @endif
              <li id="user-menu"><a href="{{route('user.profile', ['id' => Auth::id()])}}">{{trans('file.User Profile')}}</a></li>
              @if($create_sms_permission_active)
              <li id="create-sms-menu"><a href="{{route('setting.createSms')}}">{{trans('file.Create SMS')}}</a></li>
              @endif
              @if($general_setting_permission_active)
              <li id="general-setting-menu"><a href="{{route('setting.general')}}">{{trans('file.General Setting')}}</a></li>
              @endif
              @if($mail_setting_permission_active)
              <li id="mail-setting-menu"><a href="{{route('setting.mail')}}">{{trans('file.Mail Setting')}}</a></li>
              @endif
              @if($sms_setting_permission_active)
              <li id="sms-setting-menu"><a href="{{route('setting.sms')}}">{{trans('file.SMS Setting')}}</a></li>
              @endif
              @if($pos_setting_permission_active)
              <li id="pos-setting-menu"><a href="{{route('setting.pos')}}">POS {{trans('file.settings')}}</a></li>
              @endif
              @if($hrm_setting_permission_active)
              <li id="hrm-setting-menu"><a href="{{route('setting.hrm')}}"> {{trans('file.HRM Setting')}}</a></li>
              @endif
              

            </ul>
          </li>
              <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

        </ul>
 