const db = require('./db');

module.exports = function(app) {
  app.post('/send-message', (req, res) => {
    const { userId, messageContent, channelId } = req.body;
    const query = 'INSERT INTO message (message_sender_id, message_content, message_channel_id) VALUES (?, ?, ?)';

    db.query(query, [userId, messageContent, channelId], (error) => {
      if (error) {
        console.error(error);
        return res.status(500).send('Server error');
      }
      res.status(200).send('Message sent');
    });
  });

  // Define other routes here
};
