// import React from 'react'

class Reply extends React.Component {
    constructor(){
        super()
        this.state = {
            comment: "",
            postReply: false
        }
    } 

    render() {
        return (
            <div>
                <form>
                    {this.state.postReply === true ? <div></div> :
                    <div>
                        <input onChange={this.changeHandler} name="comment" value={this.state.comment}/>
                        <button type="submit" onClick={this.newComment}>reply</button>
                    </div>}
                </form>
            </div>
        )
    }

    changeHandler = (e) => {
        e.preventDefault() 
        // console.log(e.target, "new target")
        var name = e.target.name
        this.setState({
            ...this.state,
            [name]: e.target.value
        })
    }

//hopefully this will post the comment to the backend 
    // postComments = async () => {
    //     const response = await fetch('../backend/comments.php', {
    //       method: 'POST',

    //       body: JSON.stringify({comment: this.state.commnt})
    //       //send username too? 
    //     });
    //     const content = await response.json();
      
    //     console.log(content);
    //   }


    newComment = (e) => {
        e.preventDefault()
        // this.postComments();
        if(this.state.comment !== ""){
            this.props.addComment ({
                comment: this.state.comment,
            })

            this.setState({
                comment: "",
                postReply: true
            })
        }
        else alert("please enter comment")
    }
}
// export default Reply 