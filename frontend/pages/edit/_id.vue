<template>
  <div>
    <Navbar />
    <div class="container-fluid">
      <div class="row">
        <Sidebar />
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
          <h2>Edit a form</h2>
          <div class="form-group pl-3 pr-3">
            <label>Form Title</label>
            <input v-model="form.title" type="text" class="form-control" />
          </div>
          <div class="form-group pl-3 pr-3">
            <label>Mapping URL</label>
            <input
              v-model="form.mapping_url"
              type="text"
              class="form-control"
            />
          </div>
          <FormBuilder v-model="formLayout"></FormBuilder>
          <button class="btn btn-success" @click="saveForm">Save Form</button>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import { FormBuilder } from 'v-form-builder'
export default {
  name: 'FormEditComponent',
  components: {
    FormBuilder,
    // FormRenderer,
  },
  data() {
    return {
      formLayout: null,
      formValues: null,
      form: {
        title: null,
        mapping_url: null,
      },
    }
  },
  created() {
    this.getForm()
  },
  methods: {
    getForm() {
      this.$axios
        .get('/api/edit/' + this.$route.params.id)
        .then((data) => data.data)
        .then(this.setData)
    },

    setData(formLayout) {
      if (formLayout.error) {
        alert('Form not found')
        return
      }
      this.form.title = formLayout.data.title
      this.form.mapping_url = formLayout.data.mapping_url
      // set form configuration
      this.$set(this, 'formLayout', JSON.parse(formLayout.data.layout))
    },

    saveForm() {
      //   alert(JSON.stringify(this.form))
      this.$axios
        .put('/api/update/' + this.$route.params.id, {
          title: this.form.title,
          mapping_url: this.form.mapping_url,
          form_layout: JSON.stringify(this.formLayout),
        })
        .then(({ data }) => {
          alert('Form updated successfully')
          this.$router.push('/')
        })
        .catch((e) => {
          alert('Error, please check developer tools console for details', e)
        })
    },
  },
}
</script>