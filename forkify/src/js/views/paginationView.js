import View from './View.js';

import icons from 'url:../../img/icons.svg';


class PaginationView extends View {
    _parentElement = document.querySelector('.pagination');

    addHandlerClick(handler) {
        this._parentElement.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn--inline');
            if(!btn) return;
            const goToPage = +btn.dataset.goto;
            handler(goToPage);
        });
    }

    renderButton(page, direction) {
        const arrow = (direction === "prev") ? 'left' : 'right';

        const newPage = (direction === "prev") ? page - 1 : page + 1;
        
        return `
                <button data-goto="${newPage}" class="btn--inline pagination__btn--${direction}">
                    <span>Page ${newPage}</span>
                    <svg class="search__icon">
                    <use href="${icons}#icon-arrow-${arrow}"></use>
                    </svg>
                </button>
            `;
    }

    _generateMarkup() {
        const curPage = this._data.page;

        const numPages = Math.ceil(this._data.results.length / this._data.resultsPerPage);

        // Page 1, and there are other pages
        if(curPage === 1 && numPages > 1) {
            return this.renderButton(curPage, 'next');
        }

        // Last page
        if(curPage === numPages && numPages > 1) {
            return this.renderButton(curPage, 'prev');
        }
        
        // Other page
        if(curPage < numPages) {
            return this.renderButton(curPage, 'prev') + this.renderButton(curPage, 'next');
        }

        // Page 1, and there are No pages
        return '';
    }
}

export default new PaginationView();