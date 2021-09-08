<template>
  <v-container fixed>
    <v-row container  justify="center" class='main-block' spacing={3}>
      <v-col item cols="8" class="main-right" style="margin-top:75px">
        <div class="paper background-sky-light profile-block-user">
          <h4 class='paper-title-small repeat-word'>Даниил Янушковский</h4>
          <button class='default-button btn-half btn-sky repeat-button' style="margin-bottom: 0;">
            <a class="link-for-white" >Перевод</a>
          </button>
          <button class='default-button btn-half btn-sky repeat-button'>
            <a class="link-for-white" >Дальше</a>
          </button>
        </div>
      </v-col>

    </v-row>


  </v-container>

</template>

<script>
export default {
  name: "Repeat",
  computed: {
    repeatWords() {
      return this.$store.state.word.repeatWords
    }
  },
  created: function () {
    this.$store.dispatch('getWordsToRepeat');
  }
}
</script>

<style scoped>

</style>