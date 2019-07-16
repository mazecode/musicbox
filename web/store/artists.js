export const state = () => ({
  all: [
    {
      id: 1,
      type: 'music_band',
      attributes: {
        name: 'Wu-Tang Clan',
        members: [
          {
            id: 2,
            type: 'artist',
            attributes: {
              name: 'Method Man',
              music_band: {
                type: 'band',
                id: 1,
                attributes: {
                  name: 'Wu-Tang Clan'
                },
                links: {
                  self: 'http://localhost:8000/api/music/library/artists/1'
                }
              }
            },
            links: {
              self: 'http://localhost:8000/api/music/library/artists/2'
            }
          }
        ]
      },
      links: {
        self: 'http://localhost:8000/api/music/library/artists/1'
      }
    },
    {
      id: 2,
      type: 'artist',
      attributes: {
        name: 'Method Man',
        music_band: {
          type: 'band',
          id: 1,
          attributes: {
            name: 'Wu-Tang Clan'
          },
          links: {
            self: 'http://localhost:8000/api/music/library/artists/1'
          }
        }
      },
      links: {
        self: 'http://localhost:8000/api/music/library/artists/2'
      }
    }
  ]
})
