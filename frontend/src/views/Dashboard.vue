<template>
  <v-container fixed>
    <loader v-if="$store.state.isLoading"></loader>
    <v-row container  justify="center" class='main-block' spacing={3}>
      <v-col cols="4" item xs={12} md={6} class="main-right" style="margin-top:75px">
        <div class="paper background-sky-light profile-block-user">
          <img class='default-img' src="@/assets/img/Dashboard/049-messenger.png"/>
          <h4 class='paper-title-small'>{{email}}</h4>
<!--          <div>-->
<!--            <button class='default-button btn-half btn-sky'>-->
<!--              <a class="link-for-white" >Словарь</a>-->
<!--            </button>-->
            <button class='default-button btn-half btn-sky'>
              <a class="link-for-white" >Выйти</a>
            </button>
<!--          </div>-->
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


      <v-col cols="4" item xs={3} md={3} class="main-right" style="margin-top:75px">
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


      <v-col cols="4" item xs={3} md={3} class="main-right" style="margin-top:75px">
        <div class="paper background-sky-light">
          <img class='default-img' src="@/assets/img/Dashboard/052-snapchat.png"/>
          <h4 class='paper-title-small'>Повторение</h4>
          <p class='paper-title-small repeat-subtitle'>
            <span v-if="countRepeatWords === '0'">Пока нет слов для повторения</span>
            <span v-else>Вам нужно повторить {{countRepeatWords}}</span>
          </p>
          <button class='default-button btn-half btn-white' style="width:80%">
            <router-link  class="link-for-white" to='/repeat'>Приступить</router-link>
          </button>
        </div>
      </v-col>
    </v-row>
<!--    <v-row>-->
<!--      <v-col cols="4"  class="main-right" style="margin-top:75px">-->
<!--&lt;!&ndash;        <div class="paper background-sky">&ndash;&gt;-->
<!--        <v-simple-table class="paper background-sky">-->
<!--          <template v-slot:default>-->
<!--            <thead>-->
<!--            <tr>-->
<!--              <th class="text-center" style="font-size: 15px">-->
<!--                Слово-->
<!--              </th>-->
<!--              <th class="text-center" style="font-size: 15px">-->
<!--                Перевод-->
<!--              </th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr-->
<!--                v-for="item in desserts"-->
<!--                :key="item.name"-->
<!--            >-->
<!--              <td>{{ item.name }}</td>-->
<!--              <td>{{ item.calories }}</td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--          </template>-->
<!--        </v-simple-table>-->
<!--&lt;!&ndash;              </div>&ndash;&gt;-->
<!--      </v-col>-->
<!--    </v-row>-->
  </v-container>

</template>

<script>
import {mapActions, mapGetters} from "vuex";
import Loader from "@/components/Loader";

export default {
  name: "Dashboard",
  data() {
    return {
      email: JSON.parse(localStorage.getItem('user')).email,
      desserts: [
        {
          name: 'Frozen Yogurt',
          calories: 159,
        },
        {
          name: 'Ice cream sandwich',
          calories: 237,
        },
        {
          name: 'Eclair',
          calories: 262,
        },
        {
          name: 'Cupcake',
          calories: 305,
        },
        {
          name: 'Gingerbread',
          calories: 356,
        },
        {
          name: 'Jelly bean',
          calories: 375,
        },
        {
          name: 'Lollipop',
          calories: 392,
        },
        {
          name: 'Honeycomb',
          calories: 408,
        },
        {
          name: 'Donut',
          calories: 452,
        },
        {
          name: 'KitKat',
          calories: 518,
        },
      ],
    };
  },
  components: {
    loader: Loader
  },
  mounted() {
    this.$store.state.isLoading  = true;
    this.getUserStatistic()
    this.$store.state.isLoading  = false;
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