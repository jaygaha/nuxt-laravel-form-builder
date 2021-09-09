<template>
  <div>
    <Navbar />
    <div class="container-fluid">
      <div class="row">
        <Sidebar />
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
          <FormRenderer
            v-if="formLayout"
            v-model="formValues"
            :form-configuration="formLayout"
          >
          </FormRenderer>
          <b-alert show variant="primary" v-if="formSaved">
            <strong>Form Data: </strong>
            {{ this.formValues }}
            <p v-for="(v, k, index) in this.formValues" :key="index">
              {{ k }}: {{ v }}
            </p>
          </b-alert>
        </main>
      </div>
    </div>
  </div>
</template>
<script>
import { FormRenderer } from 'v-form-builder'
export default {
  name: 'GenericForm',
  components: {
    FormRenderer,
  },
  data: () => ({
    formLayout: null,
    formValues: null,
    formSaved: false,
  }),
  created() {
    this.getForm()

    this.$formEvent.$on('api-save-form-data', (value) => {
      this.formSaved = true
      return false
    })
  },
  methods: {
    getForm() {
      this.$axios
        .get('api/get-form-by-slug/' + this.$route.params.slug)
        .then((data) => data.data)
        .then(this.setData)
    },

    setData(formLayout) {
      if (formLayout.error) {
        alert('Form not found')
        return
      }

      // set form configuration
      this.$set(this, 'formLayout', JSON.parse(formLayout.data.layout))
    },
  },
}
</script>
