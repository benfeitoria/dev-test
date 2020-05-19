<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
              header
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              body
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              footer
              <md-button class="modal-default-button" v-on:click.native="close">OK</md-button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
  export default {
    methods: {
      close() {
        this.$parent.showModal = false;
      }
    }
  }
</script>