<template>
      <div class="row">

<!-- Left side columns -->
<div class="col-lg-8">
  <div class="row">

    <!-- Sales Card -->
    <div class="col-xxl-4 col-md-6">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title">Total Students</h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-people"></i>
            </div>
            <div class="ps-3">
              <h6>{{ dashboard_info.total_students }}</h6>
              <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

            </div>
          </div>
        </div>

      </div>
    </div><!-- End Sales Card -->

    <!-- Revenue Card -->
    <div class="col-xxl-4 col-md-6">
      <div class="card info-card revenue-card">
        <div class="card-body">
          <h5 class="card-title">Total Teachers</h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-people"></i>
            </div>
            <div class="ps-3">
              <h6>{{ dashboard_info.total_teachers }}</h6>
              <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

            </div>
          </div>
        </div>

      </div>
    </div><!-- End Revenue Card -->

    <!-- Customers Card -->
    <div class="col-xxl-4 col-xl-12">

      <div class="card info-card customers-card">
        <div class="card-body">
          <h5 class="card-title">Total Subjects</h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-book"></i>
            </div>
            <div class="ps-3">
              <h6>{{ dashboard_info.total_subjects }}</h6>
              <!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> -->

            </div>
          </div>

        </div>
      </div>

    </div><!-- End Customers Card -->

  </div>
</div><!-- End Left side columns -->

<!-- Right side columns -->
<div class="col-lg-4">

  <!-- Recent Activity -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Classes <span>| Today</span></h5>

      <div class="activity">

        <div class="activity-item d-flex"  v-for="(tci, index) in dashboard_info.today_class_info" :key="index">
          <div class="activite-label">{{ timeFormater(tci.start_date) }}</div>
          <i 
          v-bind:class="['bi bi-circle-fill activity-badge align-self-start',select_badge()]"
          class=''></i>
          <div class="activity-content">
            {{ tci.topic }}
          </div>
        </div><!-- End activity item-->
      </div>

    </div>
  </div><!-- End Recent Activity -->

</div><!-- End Right side columns -->

</div>
</template>
<script>

export default {
    data() {
        return {
            dashboard_info: [],
        };
    },
    mounted(){
        this.getAdminDashboardInfo();
    },
    methods: {
        async getAdminDashboardInfo() {
            let urlText = "admin/dashboard";
            let getResponse = await this.get(urlText,1,true);
            this.dashboard_info = getResponse.data.data;
        },
    },
};
</script>