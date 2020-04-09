describe('Like a post', () => {
    context('like.js', ()=> {
        it('Like', () => {
            cy.visit('localhost:3000/login')
            cy.get('input#email').type('testing@gmail.com')
            cy.get('input#password').type('testing123')
            cy.get('button[type="submit"]').click()
            const initialLikeCount = cy.get('span[class="ant-typography likeCount"]').first().invoke('text').then(parseInt)
            cy.get('svg[data-icon="heart"]').first().click()
            cy.get('span[class="ant-typography likeCount"]').first().invoke('text').then(parseInt).should('be', initialLikeCount+1)
        })
    })
})