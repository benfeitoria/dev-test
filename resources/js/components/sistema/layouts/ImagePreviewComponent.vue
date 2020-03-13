<template>
  <div>
    <input type="file" :class="{'ocultar': imagePreview }" @change="fileChange" :name="name" />

    <div
        v-if="imagePreview"
      :class="{'ocultar': !imagePreview }"
      :style="`background: url(${imagePreview})`"
      id="imagePreview"
    >
      <button
        type="button"
        class="btn"
        :class="{'ocultar': !imagePreview }"
        @click.prevent="removePreview"
      >
        <i class="fas fa-times-circle"></i>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    inputPreview: {
      required: false,
      default: null
    },
    name: {
      required: false,
      default: null
    }
  },
  data() {
    return {
      upload: "",
      imagePreview: null
    };
  },
  methods: {
    fileChange(e) {
      let files = e.target.files || e.dataTranfer.files;
      if (!files.length) return;

      this.upload = files[0];
      this.previewImage(files[0]);
    },
    previewImage(file) {
      let reader = new FileReader();
      reader.onload = e => {
        //console.log(e.target.result);
        this.imagePreview = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removePreview() {
      this.imagePreview = null;
    },
    updateInput(val) {}
  },
  created() {
    //alert(this.inputPreview);
    if (this.inputPreview) {
      this.imagePreview = this.inputPreview;
    }
  }
};
</script>

<style lang="scss" scoped>
#imagePreview {
  width: 100px;
  height: 100px;
  background-position: center !important;
  background-size: cover !important;
}

#imagePreview .btn {
  background-color: #e3342f;
  color: white;
  border-radius: 50%;
}

.ocultar {
  display: none;
}
</style>