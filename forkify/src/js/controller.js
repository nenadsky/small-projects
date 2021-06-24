import * as model from './model.js';
import recipeView from './views/recipeView.js';
import searchView from './views/searchView.js';
import resultsView from './views/resultsView.js';
import bookmarksView from './views/bookmarksView.js';
import addRecipeView from './views/addRecipeView.js';
import paginationView from './views/paginationView.js';
import {MODAL_CLOSE_SEC} from './config.js';

// import icons from '../img/icons.svg'; // Parcel 1
import 'core-js/stable';
import 'regenerator-runtime/runtime';

// https://forkify-api.herokuapp.com/v2

///////////////////////////////////////

if (module.hot) {
  module.hot.accept();
}

const controlRecipes = async function() {
  try {

    const id = window.location.hash.slice(1);
    
    if(!id) return;
    recipeView.renderSpinner();

    // 0) Update results view to mark selected search result
    resultsView.update(model.getSearchResultsPage());
    
    // 1) Loading recipe
    await model.loadRecipe(id);
    
    // 2) Rendering recipe
    recipeView.render(model.state.recipe);
    
    // 3) Updating bookmarsk view
    bookmarksView.update(model.state.bookmarks);
  } catch (err) {

    recipeView.renderError();
    console.error(err);
  }

};

const controlSearchResults = async function() {
  try {
    resultsView.renderSpinner();

    // 1) Get search query
    const query = searchView.getQuery();
    if (!query) return;

    // 2) Load search            console.log(data);
    await model.loadSearchResults(query);

    // 3) Render result
    // resultsView.render(model.state.search.results)
    resultsView.render(model.getSearchResultsPage());
    
    // 4) Render initial pagination
    paginationView.render(model.state.search);

    //test
    controlServings();

  } catch (err) {
    console.log(err);
  }
};

const controlPagination = function(goToPage) {
  // 1) Render result
  resultsView.render(model.getSearchResultsPage(goToPage));
    
  // 2) Render initial pagination
  paginationView.render(model.state.search);
};

const controlServings = function(newServings) {
  // Update the recipe servings (in the state)
  model.updateServings(newServings);

  // Update the recipe view
  // recipeView.render(model.state.recipe);
  recipeView.update(model.state.recipe);
}

const controlAddBookmark = function() {
  // 1) ADd or remove bookmark
  if(!model.state.recipe.bookmarked) model.addBookmark(model.state.recipe);
  else model.deleteBookmark(model.state.recipe.id);

  // 2) Update recipe vieew
  recipeView.update(model.state.recipe);

  // 3) Render bookmarks
  bookmarksView.render(model.state.bookmarks);
}

const controlBookmarks = function() {
  bookmarksView.render(model.state.bookmarks);
}

const controlAddRecipe = async function(newRecipe) {
  try {
    // Reder spinner
    addRecipeView.renderSpinner();

    // Upload new recipe data
    await model.uploadRecipe(newRecipe);
    console.log(model.state.recipe);
    
    // Render recipe
    recipeView.render(model.state.recipe);
    
    // Display success message
    addRecipeView.renderMessage();

    // Render bookmarsk view
    bookmarksView.render(model.state.bookmarks);

    // Change ID in the URL
    window.history.pushState(null, '', `#${model.state.recipe.id}`);

    // Close form window
    setTimeout(function() {
      addRecipeView.toggleWindow()
    }, MODAL_CLOSE_SEC * 1000);
  } catch(err) {
    console.error(' ', err);
    addRecipeView.renderError(err.message);
  }
}

const init = function() {
  bookmarksView.addHandlerRender(controlBookmarks);
  recipeView.addHandlerRender(controlRecipes);
  recipeView.addHandlerUpdateServings(controlServings);
  recipeView.addHandledAddBookmark(controlAddBookmark);
  searchView.addHandlerSearch(controlSearchResults);
  paginationView.addHandlerClick(controlPagination);
  addRecipeView.addHandlerUpload(controlAddRecipe);

};

init();

const clearBookmarks = function() {
  localStorage.clear('bookmarks');
}

// clearBookmarsk();