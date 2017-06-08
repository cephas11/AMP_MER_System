<?php
if (isset($_SESSION['meruserid'])) {
    ?> 
    <div class="layout-sidebar">
        <div class="layout-sidebar-backdrop"></div>
        <div class="layout-sidebar-body">
            <div class="custom-scrollbar">
                <nav id="sidenav" class="sidenav-collapse collapse">
                    <ul class="sidenav">
                        <li class="sidenav-search hidden-md hidden-lg">
                            <form class="sidenav-form" action="/">
                                <div class="form-group form-group-sm">
                                    <div class="input-with-icon">
                                        <input class="form-control" type="text" placeholder="Search…">
                                        <span class="icon icon-search input-icon"></span>
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li class="sidenav-heading" >Portal</li>
                        <?php
                        $scopes = $_SESSION['permissions'];
                        if (in_array("VIEW_DASHBOARD", $scopes)) {
                            ?>          
                            <li class="sidenav-item active">
                                <a href="dashboard">
                                    <span class="sidenav-icon icon icon-list"></span>
                                    <span class="sidenav-label">Dashboard </span>
                                </a>

                            </li>

                            <?php
                        }
                        if (in_array("VIEW_CONFIGURATION", $scopes)) {
                            ?>
                            <li class="sidenav-item has-subnav" id="2"  >
                                <a href="#" aria-haspopup="true">
                                    <span class="sidenav-icon icon icon-files-o"></span>
                                    <span class="sidenav-label">Configuration</span>
                                </a>
                                <ul class="sidenav-subnav collapse">
                                    <?php
                                    if (in_array("VIEW_REGIONS", $scopes)) {
                                        ?>
                                        <li><a href="configuration/region">Region Configuration</a></li>
                                        <?php
                                    }
                                    if (in_array("VIEW_DISTRICTS", $scopes)) {
                                        ?>
                                        <li><a href="configuration/districts">Districts Configuration</a></li>
                                        <?php
                                    }
                                    if (in_array("PAIR_REGION_DISTRICTS", $scopes)) {
                                        ?>
                                        <li><a href="configuration/region-districts">Pair Region and Districts </a></li>
                                        <?php
                                    }
                                    if (in_array("VIEW_CATEGORIES", $scopes)) {
                                        ?>
                                        <li><a href="configuration/categories">Categories Configuration</a></li>
                                        <?php
                                    }
                                    if (in_array("VIEW_DESCRIPTIONS", $scopes)) {
                                        ?>
                                        <li><a href="configuration/description">Description Configuration</a></li>
                                        <?php
                                    }
                                    if (in_array("PAIR_DESCRIPTION_CATEGORY", $scopes)) {
                                        ?>
                                        <li><a href="configuration/description-categories">Pair Description and Category Configuration</a></li>
                                        <?php
                                    }
                                    if (in_array("VIEW_REGISTERS", $scopes)) {
                                        ?>
                                        <li><a href="configuration/registers">Registers</a></li>
                                        <?php
                                    }
                                    if (in_array("VIEW_ACTIVITY_TYPES", $scopes)) {
                                        ?>
                                        <li><a href="configuration/activity-types">Activity Types</a></li>
                                        <?php
                                    }
                                    if (in_array("VIEW_ACTIVITY_DESCRIPTIONS", $scopes)) {
                                        ?>
                                        <li><a href="configuration/activity-description">Activity Description</a></li>
                                        <?php
                                    }
                                    if (in_array("PAIR_ACTIVITY_DESCRIPTION_TYPES", $scopes)) {
                                        ?>
                                        <li><a href="configuration/pairactivity-descriptionTypes">Pair Activity Description and Types</a></li>
                                        <?php
                                    }
                                    if (in_array("VIEW_COMMODITIES", $scopes)) {
                                        ?>
                                        <li><a href="configuration/commodity">Commodity</a></li>
                                        <?php
                                    }
                                    if (in_array("VIEW_EMPLOYMENT_TYPES", $scopes)) {
                                        ?>
                                        <li><a href="configuration/employment-type">Employment Types</a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        if (in_array("VIEW_BENEFICIARIES", $scopes)) {
                            ?>
                            <li class="sidenav-item" id="3"  >
                                <a href="beneficiary/beneficiaries-list">
                                    <span class="sidenav-icon icon icon-user"></span>
                                    <span class="sidenav-label">Beneficiaries</span>
                                </a>
                            </li>
                            <?php
                        }
                        if (in_array("VIEW_ACTIVITY_REPORT_TOOL", $scopes)) {
                            ?>
                            <li class="sidenav-item" id="4"  >
                                <a href="activity/completion-tool-activities">
                                    <span class="sidenav-icon icon icon-edit"></span>
                                    <span class="sidenav-label">Activity Reporting Tool </span>
                                </a>

                            </li>
                            <?php
                        }
                        if (in_array("VIEW_SALES_RECORD", $scopes)) {
                            ?>
                            <li class="sidenav-item " id="5"  >
                                <a href="activity/sales-tracker">
                                    <span class="sidenav-icon icon icon-list"></span>
                                    <span class="sidenav-label">Sales Records </span>
                                </a>

                            </li>
                            <?php
                        }
                        if (in_array("VIEW_FINANCIAL_SERVICE", $scopes)) {
                            ?>

                            <li class="sidenav-item " id="6"  >
                                <a href="activity/finanacial-services-tracker">
                                    <span class="sidenav-icon icon icon-calendar"></span>
                                    <span class="sidenav-label">Financial Services Tracker </span>
                                </a>

                            </li>
                            <?php
                        }
                        if (in_array("VIEW_ADOPTION_TRACKER", $scopes)) {
                            ?>
                            <li class="sidenav-item " id="7"  >
                                <a href="activity/adoption-tracker">
                                    <span class="sidenav-icon icon icon-cog"></span>
                                    <span class="sidenav-label">Adoption  Tracker </span>
                                </a>

                            </li>
                            <?php
                        }
                        if (in_array("VIEW_EMPLOYMENT_HISTORY", $scopes)) {
                            ?>
                            <li class="sidenav-item " id="8"  >
                                <a href="activity/employment-history">
                                    <span class="sidenav-icon icon icon-users"></span>
                                    <span class="sidenav-label">Employment History </span>
                                </a>

                            </li>
                            <?php
                        }
                        if (in_array("VIEW_MAPS", $scopes)) {
                            ?>

                            <li class="sidenav-item " id="9" >
                                <a href="maps/map-locator">
                                    <span class="sidenav-icon icon icon-search"></span>
                                    <span class="sidenav-label">Maps </span>
                                </a>

                            </li>

                            <?php
                        }
                        if (in_array("MANAGE_ACCOUNT", $scopes)) {
                            ?>
                            <li class="sidenav-item has-subnav" id="10"  >
                                <a href="#" aria-haspopup="true">
                                    <span class="sidenav-icon icon icon-files-o"></span>
                                    <span class="sidenav-label">Account</span>
                                </a>
                                <ul class="sidenav-subnav collapse">

                                    <li><a href="account/user-groups">User Groups</a></li>
                                    <li><a href="account/rolesandpermissions">Assign Roles And Permissions</a></li>
                                    <li><a href="account/users">Users </a></li>

                                </ul>
                            </li>
                            <?php
                        }
                        if (in_array("VIEW_REPORTS", $scopes)) {
                            ?>

                            <li class="sidenav-item has-subnav" id="11" >
                                <a href="#" aria-haspopup="true">
                                    <span class="sidenav-icon icon icon-files-o"></span>
                                    <span class="sidenav-label">Reports</span>
                                </a>
                                <ul class="sidenav-subnav collapse">

                                    <li><a href="reports/beneficiary-report">Beneficiary Report</a></li>
                                    <li><a href="reports/activity-report">Activity Report</a></li>
                                    <li><a href="reports/sales-report">Sales Report </a></li>
                                    <li><a href="reports/adoption-report">Adoption Report </a></li>
                                    <li><a href="reports/financial-report">Financial Services Report </a></li>
                                    <li><a href="reports/employment-report">Employment/Household Report </a></li>

                                </ul>
                            </li>
                            <?php
                        }
                        if (in_array("READ_AUDIT_LOGS", $scopes)) {
                            ?>
                            <li class="sidenav-item " id="5"  >
                                <a href="auditlogs">
                                    <span class="sidenav-icon icon icon-list"></span>
                                    <span class="sidenav-label">Audit Logs </span>
                                </a>

                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <?php
}
?>