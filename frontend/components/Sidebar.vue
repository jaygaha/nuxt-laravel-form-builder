<template>
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <nuxt-link to="/">Form</nuxt-link>
          </li>
          <li class="nav-item">
            <nuxt-link to="/create">New form</nuxt-link>
          </li>
        </ul>
      </div>
    </nav>
</template>

<script>
    export default {
        name: "Sidebar",
        data: () => ({

        })
    };
</script>