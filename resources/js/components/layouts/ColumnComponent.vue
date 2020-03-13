<template>
  <div :class="'col-' + sizes">
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: {
    sizes: {
      type: String,
      default: ""
    }
  }
};
</script>