<template>
  <div>
    <Navbar />
    <div class="container-fluid">
      <div class="row">
        <Sidebar />
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
          <h2>Create new form</h2>
          <div class="form-group pl-3 pr-3">
              <label>Form Title</label>
              <input v-model="form.title" type="text" class="form-control">
          </div>
          <div class="form-group pl-3 pr-3">
            <label>Mapping URL</label>
            <input v-model="form.mapping_url" type="text" class="form-control">
          </div>

          <FormBuilder v-model="form_layout"></FormBuilder>
          <button class="btn btn-success" @click="saveForm">Save Form</button>
        </main>
      </div>
    </div>
  </div>
</template>
<script>
import { FormBuilder } from 'v-form-builder'
export default {
  name: 'FormComponent',
  components: {
    FormBuilder,
  },
  data() {
    return {
      form_layout: null,
      form: {
        title: null,
        mapping_url: null,
      },
    }
  },
  methods: {
    saveForm() {
    //   alert(JSON.stringify(this.form))
      this.$axios.post('/api/store', {
          title: this.form.title,
          mapping_url: this.form.mapping_url,
          form_layout: JSON.stringify(this.form_layout)
      })
      .then(({ data }) => {
        alert('Form saved successfully')
        this.$router.push('/')
      })
      .catch((e) => {
        alert('Error, please check developer tools console for details', e)
      })
    },
  },
}
</script>
