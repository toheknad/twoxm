<template>
  <v-container fixed>
    <v-row container  justify="center" class='main-block' spacing={3}>
      <v-col item xs={12} md={6} class="main-right" style="margin-top:75px">
        <div class="paper background-sky-light profile-block-user">
          <img class='default-img' src="@/assets/img/Dashboard/049-messenger.png"/>
          <h4 class='paper-title-small'>Даниил Янушковский</h4>
          <button class='default-button btn-half btn-sky'>
            <a class="link-for-white" >Выйти</a>
          </button>
          <div class="flex-center" style="padding-bottom:25px">
            <div class="profile-block-statistic profile-border">
              <p class="profile-value-statistic">{{userStatistic.all}}</p>
              <p class="profile-under-value-statistic">Слов</p>
            </div>
            <div class="profile-block-statistic profile-border">
              <p class="profile-value-statistic">#1000</p>
              <p class="profile-under-value-statistic">Рейтинг</p>
            </div>
            <div class="profile-block-statistic">
              <p class="profile-value-statistic">{{userStatistic.learned}}</p>
              <p class="profile-under-value-statistic">Выученно</p>
            </div>
          </div>
        </div>
      </v-col>


      <v-col item xs={3} md={3} class="main-right" style="margin-top:75px">
        <div class="paper background-pink">
          <img class='default-img' src="@/assets/img/Dashboard/067-mortarboard.png"/>
          <h4 class='paper-title-small'>Тренажер</h4>
          <button class='default-button btn-half btn-white' style="width:80%">
            <router-link class="link-for-white" to='/language'>Иностранные слова</router-link>
          </button>
<!--          <button class='default-button btn-half btn-white' style="width:80%">-->
<!--            <router-link class="link-for-white" to='/login'>Другое</router-link>-->
<!--          </button>-->
        </div>
      </v-col>


      <v-col item xs={3} md={3} class="main-right" style="margin-top:75px">
        <div class="paper background-sky">
          <img class='default-img' src="@/assets/img/Dashboard/052-snapchat.png"/>
          <h4 class='paper-title-small'>Повторение</h4>
          <p class='paper-title-small repeat-subtitle'>
            <span v-if="countRepeatWords !== '0'">Вам нужно повторить {{countRepeatWords}}</span>
            <span v-else>Пока нет слов для повторения</span>
          </p>
          <button class='default-button btn-half btn-white' style="width:80%">
            <router-link  class="link-for-white" to='/repeat'>Приступить</router-link>
          </button>
        </div>
      </v-col>
    </v-row>
  </v-container>

</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
  name: "Dashboard",
  // data: {
  //   countRepeatWords: 0,
  // },
  mounted() {
    this.getUserStatistic()
    console.log(this.userStatistic)
    console.log(this.words)
  },
  computed: {
    ...mapGetters(['userStatistic']),
    countRepeatWords() {
      return this.$store.state.word.countRepeatWords
    }
  },
  created: function () {
    this.$store.dispatch('getCountWordsToRepeat');
  },
  methods: {
    ...mapActions(['getUserStatistic']),
  }
}
</script>

<style scoped>

</style>