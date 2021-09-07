<template>
  <div>
    <Navbar />
    <div class="container-fluid">
      <div class="row">
        <Sidebar />
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
          <h2>Available forms</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Version</th>
                  <th>Mapped To</th>
                  <th></th>
                </tr>
              </thead>
              <tbody v-if="$fetchState.pending">
                <tr>
                  <td colspan="5">Loading data</td>
                </tr>
              </tbody>
              <tbody v-else-if="$fetchState.error">
                <tr>
                  <td colspan="5">Error while loading data</td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr v-for="form of forms" :key="form.id">
                  <td>{{ form.id }}</td>
                  <td>{{ form.title }}</td>
                  <td>{{ form.version }}</td>
                  <td>{{ form.mapping_url }}</td>
                  <td><a :href="'/edit/' + form.id">Edit</a>|Preview</td>
                </tr>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'FormIndexComponent',
  data() {
    return {
      forms: [],
    }
  },
  async fetch() {
    const data = await fetch('/api/forms').then((res) => res.json())

    this.forms = data.data
  },
}
</script>
