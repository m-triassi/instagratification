describe('Follow', () => {
    context('follow.js', ()=> {
        it('Follow', () => {
            cy.visit('localhost:3000/login')
            cy.get('input#email').type('testing@gmail.com')
            cy.get('input#password').type('testing123')
            cy.get('button[type="submit"]').click()
            cy.get('[data-cy="postAuthor"]').eq(0).click()
            cy.get('button').contains('Follow').click()
            cy.get('button').contains('Unfollow').should('be.visible')
        })
    })
})