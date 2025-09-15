<script setup>

const props = defineProps({
    label: String,
    data1: String,
    data2: String,
    nama1: String,
    nama2: String,
})
function highlightDiff(str1, str2) {
    let maxLen = Math.max(str1.length, str2.length);
      let res1 = "", res2 = "";

      for (let i = 0; i < maxLen; i++) {
        if (str1[i] !== str2[i]) {
          res1 += str1[i] ? `<span class="text-red-500 font-bold">${str1[i]}</span>` : "";
          res2 += str2[i] ? `<span class="text-green-500 font-bold">${str2[i]}</span>` : "";
        } else {
          res1 += str1[i] || "";
          res2 += str2[i] || "";
        }
      }

     return { str1: res1, str2: res2 };
}
</script>

<template>
    <div class="my-4">
        <span class="font-bold">{{ props.label }} </span>
            <p class="font-bold text-orange-500">{{ props.nama1 }} : </p>
            <p v-html="highlightDiff(props.data1, props.data2).str1"></p>
            <span class="font-bold text-purple-500">{{ props.nama2 }} : </span>
            <p v-html="highlightDiff(props.data1, props.data2).str2"></p>
    </div>
</template>