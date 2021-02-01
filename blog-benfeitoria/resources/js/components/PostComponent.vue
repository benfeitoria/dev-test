<style>
    a {
        color: #000000;
    }

    a:hover {
        color: #646464;
        text-decoration: none;
    }
</style>
<template>
    <div class="card mb-4">
      <div class="card-body text-left">
        <h2 class="card-title">
          <slot name="title"></slot>
        </h2>
        <h5>
          <slot name="category"></slot>
        </h5>
        <br>
        <p>
          <slot name="content"></slot>
        </p>
      </div>
      <div class="d-flex justify-content-between mb-3 ml-4 mr-4">
        <div class="form-group mt-1">
          <label class="contro-label">
            <slot name="user"></slot>
          </label>
        </div>
        <div class="mt-3">
          <slot name="create"></slot>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  mounted() {},
};
</script>