    <?php
      $request_uri = explode('/', $_SERVER['REQUEST_URI']);
    ?>

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="<?php echo ($request_uri[1] == '' || $request_uri[1] == 'home')? 'active' : ''; ?>">
            <a class="" href="/">
              <i><img src="/common/img/dashboard.png" style="width: 18px; height: 18px;"></i>
              <span>หน้าหลัก</span>
            </a>
          </li>
          <li>
            <li class="<?php echo (!empty($request_uri[1]) && $request_uri[1] == 'stock')? 'active' : ''; ?>">
              <a class="" href="/stock">
                <i><img src="/common/img/stock.png" style="width: 18px; height: 18px;"></i>
                <span>สต๊อก</span>
              </a>
            </li>
          </li>
          <li>
            <li class="<?php echo (!empty($request_uri[1]) && $request_uri[1] == 'customer')? 'active' : ''; ?>">
              <a class="" href="/customer">
                <i><img src="/common/img/customer.png" style="width: 18px; height: 18px;"></i>
                <span>ลูกค้า</span>
              </a>
            </li>
          </li>
          <li>
            <li class="<?php echo (!empty($request_uri[1]) && $request_uri[1] == 'report')? 'active' : ''; ?>">
              <a class="" href="/report">
                <i><img src="/common/img/report.png" style="width: 18px; height: 18px;"></i>
                <span>รายงาน</span>
              </a>
            </li>
          </li>
          <li>
            <li class="<?php echo (!empty($request_uri[1]) && $request_uri[1] == 'search')? 'active' : ''; ?>">
              <a class="" href="/search">
                <i><img src="/common/img/search.png" style="width: 18px; height: 18px;"></i>
                <span>ค้นหา</span>
              </a>
            </li>
          </li>
          <li>
            <li class="<?php echo (!empty($request_uri[1]) && $request_uri[1] == 'billing')? 'active' : ''; ?>">
              <a class="" href="/billing">
                <i><img src="/common/img/billing.png" style="width: 18px; height: 18px;"></i>
                <span>วางบิล</span>
              </a>
            </li>
          </li>
          <li>
            <li class="<?php echo (!empty($request_uri[1]) && $request_uri[1] == 'deposit')? 'active' : ''; ?>">
              <a class="" href="/deposit">
                <i><img src="/common/img/deposit.png" style="width: 18px; height: 18px;"></i>
                <span>ฝากสินค้า</span>
              </a>
            </li>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->