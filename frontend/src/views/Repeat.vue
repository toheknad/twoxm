<template>
  <v-container fixed>
    <v-row container  justify="center" class='main-block' spacing={3}>
      <v-col item cols="8" class="main-right" style="margin-top:75px">
        <div class="paper background-sky-light profile-block-user">
            <div v-if="currentWord < repeatWords.length">
              <h4  class='paper-title-small repeat-word'>{{repeatWords[currentWord]['word']}} <span  v-if="showTranslate">- {{repeatWords[currentWord]['translate']}}</span></h4>
              <p class="repeat-word-count">Еще слов к повторению: {{repeatWords.length-currentWord}}</p>
              <a v-if="!showTranslate" class="link-for-white"   @click="this.upTranslate">
                <button class='default-button btn-half btn-sky repeat-button btn-black' style="margin-bottom: 0;">
                 Перевод
                </button>
              </a>
              <a v-if="showTranslate" class="link-for-white"    @click="this.closeTranslate">
                <button class='default-button btn-half btn-sky repeat-button btn-black' style="margin-bottom: 0;">
                  Скрыть
                </button>
              </a>
              <a class="link-for-white"  @click="this.nextWord">
                <button class='default-button btn-half btn-sky repeat-button btn-black'>
                  Дальше
                </button>
              </a>
            </div>
            <div v-else>
              <h4  class='paper-title-small repeat-word'>Поздравляю!</h4>
              <p class="">Вы повторили все слова</p>
              <button class='default-button btn-half btn-sky repeat-button '>
                <router-link  class="link-for-white" to='/dashboard'>Вернуться</router-link>
              </button>
            </div>
        </div>

      </v-col>

    </v-row>


  </v-container>

</template>

<script>
import { mapActions, mapGetters} from 'vuex'
import axios from "axios";
import authHeader from "@/tools/auth-api";
export default {
  name: "Repeat",
  data() {
    return {
      currentWord: 0,
      showTranslate: false
    }
  },
  mounted() {
    this.getWordsToRepeat()
    console.log(this.words)
  },
  computed: {
    ...mapGetters(['repeatWords'])
  },
  methods: {
    ...mapActions(['getWordsToRepeat']),
    nextWord: function () {
      const Word = new FormData();
      Word.append("id", this.repeatWords[this.currentWord]['id']);
      axios.post('/api/repeat/save-word-as-repeated', Word, { headers: authHeader() }).then( response => {
        if (response.data) {
          console.log(response.data)
          this.currentWord += 1
        }
      })
    },
    upTranslate: function() {
      this.showTranslate = true;
    },
    closeTranslate: function() {
      this.showTranslate = false;
    }
  }
}
</script>

<style scoped>

</style>