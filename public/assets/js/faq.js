// Instantiate the Bloodhound suggestion engine
var movies = new Bloodhound({
    datumTokenizer: function (datum) {
        return Bloodhound.tokenizers.whitespace(datum.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: 'http://api.themoviedb.org/3/search/movie?query=%QUERY&api_key=f22e6ce68f5e5002e71c20bcba477e7d',
        filter: function (movies) {
            console.log(movies);
            // Map the remote source JSON array to a JavaScript object array
            return $.map(movies.results, function (movie) {
                return {
                    value: movie.original_title,
                    release_date: movie.release_date
                };
            });
        }
    },
    limit: 10
});

// Initialize the Bloodhound suggestion engine
movies.initialize();

// Instantiate the Typeahead UI
$('#scrollable-dropdown-menu .typeahead').typeahead(null, {
    displayKey: 'value',
    source: movies.ttAdapter(),
    templates: {
        suggestion: Handlebars.compile("<p style='padding:6px'><b>{{value}}</b> - Release date {{release_date}} </p>"),
        footer: Handlebars.compile("<b>Searched for '{{query}}'</b>")
    }
});



//VUE jS Search
// new Vue({
//     el: '#app',
//     data () {
//       return {
//         textSearch :'',
//         info: [],
//         loading: true,
//         errored: false
//       }
//     },
  
//     created: function() {
//       var that = this;
//       axios.get('<?php echo base_url()?>home/getFaq')
//       .then(function (response) {
//         this.info = response.data.info;
//       })
//       .catch(function (error) {
//         console.log(error);
//       });
//     },
  
//     computed: {
//       filterInfo: function() {
//           var textSearch = this.textSearch;
//           return this.info.filter(function(el) {
//             return el.search.toLowerCase().indexOf(textSearch.toLowerCase()) !== -1;
//           });
//       }
//     },
   
//     mounted () {
//       axios
//         .get('<?php echo base_url()?>home/getFaq')
//         .then(response => {
//           this.info = response.data.info
//         })
//         .catch(error => {
//           console.log(error)
//           this.errored = true
//         })
//         .finally(() => this.loading = false)
//     }
//   })